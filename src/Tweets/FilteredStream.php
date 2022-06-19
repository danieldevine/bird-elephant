<?php

namespace Coderjerk\BirdElephant\Tweets;

use Coderjerk\BirdElephant\ApiBase;
use Coderjerk\BirdElephant\Request;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Filters the real-time stream
 * of public Tweets.
 *
 * @author Dan Devine <dandevine0@gmail.com>
 */
class FilteredStream extends ApiBase
{
    /**
     * endpoint
     *
     * @var string
     */
    public string $uri = 'tweets/search/stream';

    private array $credentials;


    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Connects to filtered stream
     *
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function connectToStream(array $params): object
    {
        return $this->get($this->credentials, $this->uri, $params, null, true);
    }

    /**
     * Gets filtered stream rules
     *
     * @return object
     * @throws GuzzleException
     */
    public function getRules(): object
    {
        $uri = $this->uri . '/rules';
        $params = [];

        $request = new Request($this->credentials);
        return $request->authorisedRequest('GET', $uri, $params);
    }

    /**
     * Sets one or more filtered stream rules
     *
     * @param string $value
     * @param string $tag
     * @return object
     * @throws GuzzleException
     */
    public function setRules(string $value, string $tag): object
    {
        $uri = $this->uri . '/rules';

        $rules =  [
            [
                'value' => $value,
                'tag' => $tag,
            ]
        ];

        $params = [];
        $data = ['add' => $rules];

        $request = new Request($this->credentials);
        return $request->authorisedRequest('POST', $uri, $params, $data);
    }

    /**
     * deletes a single filtered stream rule
     * identified by id
     *
     * @param string $id
     * @return object
     * @throws GuzzleException
     */
    public function deleteRule(string $id): object
    {
        $uri = $this->uri . '/rules';

        $rules =  [
            'ids' => [
                $id
            ]
        ];

        $params = [];
        $data = ['delete' => $rules];

        $request = new Request($this->credentials);
        return $request->authorisedRequest('POST', $uri, $params, $data);
    }

    /**
     * Deletes all filtered stream rules
     *
     * @return string
     * @throws GuzzleException
     */
    public function deleteAllRules(): string
    {
        $rules = $this->getRules();

        if ($rules && property_exists($rules, 'data')) {
            foreach ($rules->data as $rule) $this->deleteRule($rule->id);
            return 'rules deleted';
        } else return 'No rules to delete';
    }
}
