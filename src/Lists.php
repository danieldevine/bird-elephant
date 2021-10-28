<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\Lists\ManageListFollows;
use Coderjerk\ElephantBird\Lists\ManageListMembers;
use Coderjerk\ElephantBird\Lists\ManageLists;
use Coderjerk\ElephantBird\Lists\ManagePinnedList;

class Lists
{
    public $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    public function manageLists()
    {
        return new ManageLists($this->credentials);
    }

    public function manageListFollows()
    {
        $manage_list_follows = new ManageListFollows;
    }

    public function manageListMembers()
    {
    }


    public function managePinnedList()
    {
    }
}
