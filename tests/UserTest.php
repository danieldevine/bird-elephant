<?php

namespace Coderjerk\Tests;

use Coderjerk\BirdElephant\User;
use Coderjerk\BirdElephant\Users\Lists;
use Coderjerk\Tests\BaseTest;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class UserTest extends BaseTest
{
    protected array $credentials;
    protected string $username;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->credentials = $this->setUpCredentials();
        $this->username = 'coderjerk';
        $this->user = new User($this->credentials, $this->username);
    }

    /**
     * @throws GuzzleException
     */
    public function testSpaces()
    {
        $case = $this->user->spaces();
        $this->assertIsObject($case->data);
    }

    public function testFollowing()
    {
        $case = $this->user->following();
        $this->assertIsArray($case->data);
    }


    public function testTweets()
    {
        $case = $this->user->tweets();
        $this->assertIsArray($case->data);
    }

    /**
     * @throws GuzzleException
     */
    public function testGet()
    {
        $case = $this->user->get();
        $this->assertIsObject($case->data);
    }

    public function testUnlike()
    {
    }

    /**
     * @throws GuzzleException
     */
    public function testLikes()
    {
        $case = $this->user->likes();
        $this->assertIsArray($case->data);
    }

    public function testLists()
    {
        $lists = $this->user->lists();
        $this->assertInstanceOf(Lists::class, $lists);
    }

    public function testLike()
    {
    }

    /**
     * @throws GuzzleException
     */
    public function testBlocks()
    {
        $case = $this->user->blocks();
        $this->assertIsArray($case->data);
    }

    /**
     * @throws GuzzleException
     */
    public function testMentions()
    {
        $case = $this->user->mentions();
        $this->assertIsArray($case->data);
    }

    public function testFollow()
    {
    }

    /**
     * @throws GuzzleException
     */
    public function testMutes()
    {
        $case = $this->user->mutes();
        $this->assertIsArray($case->data);
    }

    public function testFollowers()
    {
        $case = $this->user->followers();
        $this->assertIsArray($case->data);
    }

    public function testRetweet()
    {
    }

    public function testUnmute()
    {
    }

    public function testMute()
    {
    }

    public function testUnfollow()
    {
    }

}
