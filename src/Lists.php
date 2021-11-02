<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\Lists\ManageLists;
use Coderjerk\ElephantBird\Lists\Members;


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
    public function create($name, $description = false, $private = false)
    {
        return $this->lists->createList($name, $description, $private);
    }

    /**
     * DELETE /2/lists/:id
     *
     * @return object|exception
     */
    public function delete($id)
    {
        return $this->lists->deleteList($id);
    }

    /**
     * PUT /2/lists/:id
     *
     * @return object|exception
     */
    public function update($id, $name, $description = false, $private = false)
    {
        return $this->lists->updateList($id, $name, $description, $private);
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
