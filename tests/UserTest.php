<?php
namespace Coderjerk\Tests;

use Coderjerk\BirdElephant\User;
use Coderjerk\BirdElephant\Users\Lists;
use Coderjerk\Tests\BaseTest;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class UserTest extends BaseTest
{
    private array $credentials;
    private string $username;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->credentials = $this->setUpCredentials();
        $this->username = 'coderjerk';
        $this->user = new User($this->credentials, $this->username);
    }

    public function testSpaces()
    {

    }

    public function testFollowing()
    {

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

    public function testUnblock()
    {

    }

    public function testUnretweet()
    {

    }

    public function testTweets()
    {

    }

    public function testGet()
    {

    }

    public function testUnlike()
    {

    }

    public function testLikes()
    {

    }

    public function testLists()
    {
        $lists = $this->user->lists();
        $this->assertInstanceOf(Lists::class, $lists);
    }

    public function testLike()
    {

    }

    public function testBlocks()
    {

    }

    public function testMentions()
    {

    }

    public function testBlock()
    {

    }

    public function testFollow()
    {

    }

    /**
     * @throws GuzzleException
     */
    public function testMutes()
    {
        $mutes = $this->user->mutes();
        $this->assertIsArray($mutes->data);
    }

    public function testFollowers()
    {

    }
}
