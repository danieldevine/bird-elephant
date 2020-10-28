<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\Request;

/**
 * Undocumented class
 */
class FilteredStream
{

    public $uri = 'tweets/search/stream';

    public function connectToStream($params)
    {
        $request = new Request;
        return $request->makeRequest('GET', $this->uri, $params);
    }

    public function getRules()
    {
    }

    public function setRules($value, $tag)
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

        $request = new Request;
        return $request->makeRequest('POST', $uri, $params, $data);
    }
}