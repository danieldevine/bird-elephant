<?php

namespace  Coderjerk\Tests;

use Coderjerk\BirdElephant\BirdElephant;
use Coderjerk\BirdElephant\Tweets;
use Coderjerk\BirdElephant\Tweets\TweetCounts;
use PHPUnit\Framework\TestCase;

class TweetsTest extends BaseTest
{
    protected array $credentials;
    protected Tweets $tweets;

    protected function setUp(): void
    {
        parent::setUp();

        $this->credentials = $this->setUpCredentials();
        $this->tweets = new Tweets($this->credentials);
    }

    public function testReply()
    {
        $case = $this->tweets->reply();
        self::assertInstanceOf(Tweets\Reply::class, $case);
    }

    public function testSearch()
    {
        $case = $this->tweets->search();
        self::assertInstanceOf(Tweets\Search::class, $case);
    }

    public function testCount()
    {
        $case = $this->tweets->count();
        self::assertInstanceOf(Tweets\TweetCounts::class, $case);
    }
}
