<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\Request;

/**
 * Undocumented class
 */
class FilteredStream
{
    /**
     * Undocumented variable
     *
     * @var string
     */
    public $uri = 'tweets/search/stream';

    /**
     * Undocumented function
     *
     * @param [type] $params
     * @return void
     */
    public function connectToStream($params)
    {
        $request = new Request;
        return $request->makeRequest('GET', $this->uri, $params, null, true);
    }

    /**
     * Undocumented function
     *
     * @return Object
     */
    public function getRules()
    {
        $uri = $this->uri . '/rules';
        $params = [];

        $request = new Request;
        return $request->makeRequest('GET', $uri, $params);
    }

    /**
     * Undocumented function
     *
     * @param [type] $value
     * @param [type] $tag
     * @return Object
     */
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

    /**
     * Undocumented function
     *
     * @param [type] $value
     * @param [type] $tag
     * @return Object
     */
    public function deleteRule($id)
    {
        $uri = $this->uri . '/rules';

        $rules =  [
            'ids' => [
                $id
            ]
        ];

        $params = [];
        $data = ['delete' => $rules];

        $request = new Request;
        return $request->makeRequest('POST', $uri, $params, $data);
    }

    /**
     * Deletes all rules
     *
     * @return Object
     */
    public function deleteAllRules()
    {
        $rules = $this->getRules();

        if ($rules && property_exists($rules, 'data')) {
            foreach ($rules->data as $rule) {
                $this->deleteRule($rule->id);
            }
        } else {
            return 'No rules to delete';
        }
    }
}