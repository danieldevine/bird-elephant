<?php

namespace Coderjerk\BirdElephant;

use Coderjerk\BirdElephant\Lists\ManageLists;
use Coderjerk\BirdElephant\Lists\Members;

class Lists
{
    public array $credentials;
    private ManageLists $lists;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
        $this->lists =  new ManageLists($this->credentials);
    }

    /**
     * POST /2/lists
     *
     * @param string $list_name
     * @param bool $list_description
     * @param bool $private
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(string $list_name, bool $list_description, bool $private): object
    {
        return $this->lists->createList($list_name, $list_description, $private);
    }

    /**
     * DELETE /2/lists/:id
     *
     * @param string $list_id
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(string $list_id): object
    {
        return $this->lists->deleteList($list_id);
    }

    /**
     * PUT /2/lists/:id
     *
     * @param string $list_id
     * @param string $list_name
     * @param bool $list_description
     * @param bool $private
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(string $list_id, string $list_name, bool $list_description, bool $private): object
    {
        return $this->lists->updateList($list_id, $list_name, $list_description, $private);
    }

    /**
     * POST /2/lists/:id/members
     * DELETE /2/lists/:id/members/:user_id
     *
     * @return Members
     */
    public function members(): Members
    {
        return new Members($this->credentials);
    }
}
