<?php

namespace Coderjerk\BirdElephant;

use Coderjerk\BirdElephant\Lists\ManageLists;
use Coderjerk\BirdElephant\Lists\Members;


class Lists
{
    public $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
        $this->lists =  new ManageLists($this->credentials);
    }


    /**
     * POST /2/lists
     *
     * @return object|exception
     */
    public function create($list_name, $list_description = false, $private = false)
    {
        return $this->lists->createList($list_name, $list_description, $private);
    }

    /**
     * DELETE /2/lists/:id
     *
     * @return object|exception
     */
    public function delete($list_id)
    {
        return $this->lists->deleteList($list_id);
    }

    /**
     * PUT /2/lists/:id
     *
     * @return object|exception
     */
    public function update($list_id, $list_name, $list_description = false, $private = false)
    {
        return $this->lists->updateList($list_id, $list_name, $list_description, $private);
    }

    /**
     * POST /2/lists/:id/members
     * DELETE /2/lists/:id/members/:user_id
     *
     * @return void
     */
    public function members()
    {
        return new Members($this->credentials);
    }
}
