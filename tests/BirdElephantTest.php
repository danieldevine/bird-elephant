<?php

namespace Coderjerk\Tests;

use Coderjerk\BirdElephant\BirdElephant;
use Coderjerk\BirdElephant\Compliance;
use Coderjerk\BirdElephant\Lists;
use Coderjerk\BirdElephant\Spaces;
use Coderjerk\BirdElephant\Tweets;
use Coderjerk\BirdElephant\User;
use Coderjerk\BirdElephant\Users;

class BirdElephantTest extends BaseTest
{
    protected array $credentials;

    protected function setUp(): void
    {
        parent::setUp();

        $this->credentials = $this->setUpCredentials();
        $this->app = new BirdElephant($this->credentials);
    }

    public function testUser()
    {
        $case = $this->app->user('coderjerk');
        self::assertInstanceOf(User::class, $case);
    }

    public function testTweets()
    {
        $case = $this->app->tweets();
        self::assertInstanceOf(Tweets::class, $case);
    }

    public function testCompliance()
    {
        $case = $this->app->compliance();
        self::assertInstanceOf(Compliance::class, $case);
    }

    public function testLists()
    {
        $case = $this->app->lists();
        self::assertInstanceOf(Lists::class, $case);
    }

    public function testSpaces()
    {
        $case = $this->app->spaces();
        self::assertInstanceOf(Spaces::class, $case);
    }

    public function testUsers()
    {
        $case = $this->app->users();
        self::assertInstanceOf(Users::class, $case);
    }
}
