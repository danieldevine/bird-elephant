<?php
namespace Coderjerk\Tests;

use Coderjerk\BirdElephant\Users;
use GuzzleHttp\Exception\GuzzleException;

class UsersTest extends BaseTest
{
    protected array $credentials;
    protected string $username;
    protected Users $users;

    protected function setUp(): void
    {
        parent::setUp();

        $this->credentials = $this->setUpCredentials();
        $this->username = 'coderjerk';
        $this->users = new Users($this->credentials, $this->username);
    }

    /**
     * @throws GuzzleException
     */
    public function testLookup()
    {
        $users = $this->users->lookup(['coderjerk', 'dril', 'spanish__eddie']);
        self::assertIsArray($users->data);
    }
}
