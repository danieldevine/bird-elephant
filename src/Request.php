<?php

namespace Coderjerk\BirdElephant;

use GuzzleHttp\Client;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use GuzzleHttp\HandlerStack;

/**
 * Handles http requests to the Twitter API.
 *
 * @author Dan Devine <dandevine0@gmail.com>
 */
class Request
{
    protected array $credentials;

    protected string $base_uri = 'https://api.twitter.com/';

    protected string $media_upload_path = 'media/upload.json';

    private ?Client $uploadClient = null;

    const ASYNC_MEDIA_CATEGORIES = ['tweet_gif', 'tweet_video'];

    const ASYNC_MEDIA_CHUNKSIZE = (1024 * 1024) * 4;


    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @param string $http_method
     * @param string $path
     * @param array|null $params
     * @param array|null $data
     * @param false $stream
     * @param false $signed
     * @param string|null $api_version
     * @return object
     * @throws GuzzleException
     */
    public function authorisedRequest(
        string $http_method,
        string $path,
        ?array $params,
        ?array $data = null,
        bool $stream = false,
        bool $signed = false,
        ?string $api_version = '2'
    ): object {

        $args = [
            'http_method' => $http_method,
            'path'        => $path,
            'params'      => $params,
            'data'        => $data,
            'stream'      => $stream,
            'api_version' => $api_version
        ];

        if ($signed === true && (empty($this->credentials['token_identifier']) || empty($this->credentials['token_secret']))) {

            throw new InvalidArgumentException('A 1.0a token is required for this endpoint.');
        }

        if ($signed === false && (isset($this->credentials['auth_token']) || isset($this->credentials['bearer_token']))) {

            return $this->bearerTokenRequest(
                $args,
                $this->credentials['auth_token'] ?? $this->credentials['bearer_token']
            );
        }

        return $this->userContextRequest($args);
    }

    /**
     * OAuth 2 bearer token request
     *
     * @param array $args
     * @param string $token
     * @return object
     * @throws GuzzleException
     */
    public function bearerTokenRequest($args, $token): object
    {
        $client = new Client([
            'base_uri' => $this->base_uri . $args['api_version'] . '/'
        ]);

        try {
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept'        => 'application/json',
            ];

            $path = $args['path'];

            //thanks to Guzzle's lack of flexibility with url encoding we have to manually set up the query to preserve colons.
            if (isset($args['params'])) {
                $args['params'] = http_build_query($args['params']);
                $path = $args['path'] . '?' . str_replace('%3A', ':', $args['params']);
            }

            if (!isset($args['data'])) {
                $args['data'] === null;
            }

            $request  = $client->request($args['http_method'], $path, [
                'headers' => $headers,
                'json'    => $args['data'],
                'stream'  => $args['stream'] === true
            ]);

            //if we're streaming the response, echo otherwise return
            if ($args['stream'] === true) {
                $body = $request->getBody();
                while (!$body->eof()) {
                    echo json_decode($body->read(1300));
                }
            } else {
                $body = $request->getBody()->getContents();
                return json_decode($body);
            }
        } catch (ClientException | ServerException $e) {
            throw $e;
        }
    }

    /**
     * Signed requests for logged in users
     * using OAuth 1.0a - will be deprecated in future in
     * favour of OAuth 2.0 with PKCE
     *
     * @param array $args
     * @return object
     * @throws GuzzleException
     */
    public function userContextRequest($args): object
    {
        $path = $this->base_uri . $args['api_version'] . '/' . $args['path'];

        $stack = HandlerStack::create();

        $middleware = new Oauth1([
            'consumer_key'    => $this->credentials['consumer_key'],
            'consumer_secret' => $this->credentials['consumer_secret'],
            'token'           => $this->credentials['token_identifier'],
            'token_secret'    => $this->credentials['token_secret']
        ]);

        $stack->push($middleware);

        $client = new Client([
            'base_uri' => $this->base_uri . $args['api_version'] . '/',
            'handler'  => $stack
        ]);

        try {
            $request  = $client->request($args['http_method'], $path, [
                'auth'  => 'oauth',
                'query' => $args['params'],
                'json'  => $args['data'],
                // 'debug' => true
            ]);

            //if we're streaming the response, echo otherwise return
            if ($args['stream'] === true) {

                $body = $request->getBody();
                while (!$body->eof()) {
                    echo json_decode($body->read(1300));
                }
            } else {
                $body = $request->getBody()->getContents();
                return json_decode($body);
            }
        } catch (ClientException | ServerException $e) {
            throw $e;
        }
    }

    private function getUploadClient()
    {

        if ($this->uploadClient) {
            return $this->uploadClient;
        }

        $stack = HandlerStack::create();

        $stack->push(new Oauth1([
            'consumer_key'    => $this->credentials['consumer_key'],
            'consumer_secret' => $this->credentials['consumer_secret'],
            'token'           => $this->credentials['token_identifier'],
            'token_secret'    => $this->credentials['token_secret']
        ]));

        return $this->uploadClient = new Client([
            'base_uri' => 'https://upload.twitter.com/1.1/',
            'handler' => $stack
        ]);
    }

    /**
     * @param string $media
     * @param ?string $mimeType
     * @throws GuzzleException
     */
    public function uploadMedia(string $media, ?string $mimeType)
    {

        list($mimeType, $totalBytes) = $this->getMediaInfo($media, $mimeType);

        if ($this->isAsyncUpload($mimeType)) {

            $mediaData = $this->initUpload($mimeType, $totalBytes);

            $mediaId = $mediaData->media_id_string;

            $this->appendUpload($media, $mediaId);

            $this->finalizeUpload($mediaId);

            // Wait for processing

            while (true) {

                $status = $this->uploadStatus($mediaId);

                if (!$status->processing_info || !in_array($status->processing_info->state, ['pending', 'in_progress'])) {
                    break;
                }

                sleep($status->processing_info->check_after_secs);
            }

            if (!empty($status->processing_info->state) && $status->processing_info->state == 'failed') {
                throw new \RuntimeException(
                    $status_response->processing_info->error->name . (!empty($status_response->processing_info->error->message) ? ": " . $status_response->processing_info->error->message : ''),
                    $status_response->processing_info->error->code ?? 0
                );
            }

            return $mediaData;
        } else {

            try {
                $request  = $this->getUploadClient()->request('POST', $this->media_upload_path, [
                    'auth' => 'oauth',
                    'multipart' => [
                        [
                            'name'     => 'media_data',
                            'contents' => base64_encode(file_get_contents($media))
                        ]
                    ]
                ]);

                $body = $request->getBody()->getContents();

                return json_decode($body, false, 512, JSON_THROW_ON_ERROR);
            } catch (ClientException | ServerException $e) {
                throw $e;
            }
        }
    }


    /**
     * Request a media ID from Twitter.
     *
     * @param string $mimeType
     * @param int $totalBytes
     * @throws GuzzleException
     */
    private function initUpload(string $mimeType, int $totalBytes): object
    {

        $response = $this->getUploadClient()->request('POST', $this->media_upload_path, [
            'auth' => 'oauth',
            'form_params' => [
                'command'        => 'INIT',
                'media_category' => $this->getMediaCategeoryForMimeType($mimeType),
                'media_type'     => $mimeType,
                'total_bytes'    => $totalBytes,
            ]
        ]);

        return json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * Upload $media data in chunks.
     *
     * @param string $media
     * @param string $mediaId
     * @throws GuzzleException
     */
    private function appendUpload(string $media, string $mediaId): void
    {

        $fileHandle = fopen($media, 'rb');

        $segmentIndex = 0;

        while (!feof($fileHandle)) {

            $this->getUploadClient()->request('POST', $this->media_upload_path, [
                'auth' => 'oauth',
                'form_params' => [
                    'command'  => 'APPEND',
                    'media_id' => $mediaId,
                    'media_data' => base64_encode(fread($fileHandle, self::ASYNC_MEDIA_CHUNKSIZE)),
                    'segment_index' => $segmentIndex++
                ]
            ]);
        }

        fclose($fileHandle);
    }

    /**
     * Tell Twitter the upload is done and processing should begin.
     *
     * @param string $mediaId
     * @throws GuzzleException
     */
    private function finalizeUpload(string $mediaId): void
    {
        $this->getUploadClient()->request('POST', 'media/upload.json', [
            'auth' => 'oauth',
            'form_params' => [
                'command'  => 'FINALIZE',
                'media_id' => $mediaId,
            ]
        ]);
    }

    /**
     * Get media processing status from Twitter.
     *
     * @param string $mediaId
     * @throws GuzzleException
     */
    private function uploadStatus(string $mediaId): object
    {
        $response = $this->getUploadClient()->request('GET', 'media/upload.json', [
            'auth' => 'oauth',
            'form_params' => [
                'command'  => 'STATUS',
                'media_id' => $mediaId,
            ]
        ]);

        return json_decode((string) $response->getBody(), false, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * Get media type and size.
     *
     * @param string $media
     * @param ?string $mimeType
     * @throws GuzzleException
     */
    private function getMediaInfo(string $media, ?string $mimeType): array
    {

        $isRemote = (bool) parse_url($media, PHP_URL_SCHEME);

        if ($isRemote) {

            // Using a HEAD request is better here because we don't have to transfer the entire file yet, and the upload process can
            // operate directly on a stream as necessary. The mime_content_type() function only works locally. The getimagesize() function
            // does use a built-in stream wrapper for remote URLs but will transfer the entire file. The overhead of transferring the entire
            // file unnecessarily becomes much more of an issue with larger videos.

            $response = (new Client())->head($media);
            $totalBytes = $response->getHeader('content-length')[0] ?? null;
            $mimeType = $mimeType ?? $response->getHeader('content-type')[0] ?? null;
        } else {

            $totalBytes = filesize($media);
        }

        if ($mimeType === null || $mimeType === false) {

            if (function_exists('mime_content_type') && !$isRemote) {
                $mimeType = mime_content_type($media);
            } else {
                // This only works for images, not video
                $size = getimagesize($media);
                $mimeType = $size['mime'] ?? false;
            }

            if ($mimeType === false) {
                throw new \RuntimeException('Could not determine the media mime type and none was provided. Install the FileInfo php extension or pass a MIME type as the second argument.');
            }
        }

        return [$mimeType, $totalBytes];
    }

    /**
     * Get Twitter media category for given MIME type
     *
     * @param string $mimeType
     * @throws GuzzleException
     */
    private function getMediaCategeoryForMimeType(string $mimeType): string
    {
        list($type, $subtype) = explode('/', $mimeType);
        switch ($type) {
            case 'image':
                return $subtype == 'gif' ? 'tweet_gif' : 'tweet_image';
            case 'video':
                return 'tweet_video';
                break;
        }
    }

    /**
     * Determine whether given MIME type should be uploaded synchronously or asynchronously.
     *
     * @param string $mimeType
     * @throws GuzzleException
     */
    private function isAsyncUpload($mimeType)
    {
        return in_array(
            $this->getMediaCategeoryForMimeType($mimeType),
            self::ASYNC_MEDIA_CATEGORIES,
        );
    }
}
