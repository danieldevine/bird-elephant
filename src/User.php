<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\ApiBase;
use Coderjerk\ElephantBird\Users\Follows;
use Coderjerk\ElephantBird\Users\Blocks;
use Coderjerk\ElephantBird\Users\Mutes;
use Coderjerk\ElephantBird\Users\Likes;
use Coderjerk\ElephantBird\Tweets\Retweets;
use Coderjerk\ElephantBird\Users\Lists;

class User extends ApiBase
{
    protected $credentials;

    public function __construct($credentials, $username)
    {
        $this->credentials = $credentials;
        $this->username = $username;
        $this->follows = new Follows($this->credentials, $this->username);
        $this->blocks = new Blocks($this->credentials, $this->username);
        $this->mutes = new Mutes($this->credentials, $this->username);
        $this->likes = new Likes($this->credentials, $this->username);
        $this->retweets = new Retweets($this->credentials, $this->username);
    }

    /**
     * Gets a Twitter user's followers
     *
     * @param array $params
     * @return object|exception
     */
    public function followers($params = [])
    {
        return $this->follows->getFollowers($params);
    }

    /**
     * Gets a Twitter user's followed accounts
     *
     * @param array $params
     * @return object|exception
     */
    public function following($params = [])
    {
        return $this->follows->getFollowing($params);
    }

    /**
     * Follows a given user
     *
     * @param string $target_username the user to follow
     * @return object|exception
     */
    public function follow($target_username)
    {
        return $this->follows->follow($target_username);
    }

    /**
     * Unfollows a given user
     *
     * @param string $target_username the user to unfollow
     * @return object|exception
     */
    public function unfollow($target_username)
    {
        return $this->follows->unfollow($target_username);
    }

    /**
     * Gets the blocked accounts of a Twitter user.
     *
     * @param array $params
     * @return object|exception
     */
    public function blocks($params = [])
    {
        return $this->blocks->lookup($params);
    }

    /**
     * Blocks a given user
     *
     * @param string  $target_username the user name to block
     * @return object|exception
     */
    public function block($target_username)
    {
        return $this->blocks->block($target_username);
    }

    /**
     * Unblocks a given user
     *
     * @param string $target_username the user name to unblock
     * @return object|exception
     */
    public function unblock($target_username)
    {
        return $this->blocks->unblock($target_username);
    }

    /**
     * Gets the muted accounts of a Twitter user.
     *
     * @param array $params
     * @return object|exception
     */
    public function mutes($params = [])
    {
        return $this->mutes->lookup($params);
    }

    /**
     * Mutes a given user
     *
     * @param string $target_username the user to mute
     * @return object|exception
     */
    public function mute($target_username)
    {
        return $this->mutes->mute($target_username);
    }

    /**
     * Unmutes a given user
     *
     * @param string $target_username the user to unmute
     * @return object|exception
     */
    public function unmute($target_username)
    {
        return $this->mutes->unmute($target_username);
    }

    /**
     * Gwets the named user's last 100 likes
     *
     * @param array $params
     * @return object|exception
     */
    public function likes($params = [])
    {
        return $this->likes->lookup($params);
    }

    /**
     * Likes a tweet on behalf of the authenticated user
     *
     * @param string $target_tweet_id
     * @return object|exception
     */
    public function like($target_tweet_id)
    {
        return $this->likes->like($target_tweet_id);
    }

    /**
     * Unlikes a tweet on behalf of the authenticated user
     *
     * @param string $target_tweet_id
     * @return object|exception
     */
    public function unlike($target_tweet_id)
    {
        return $this->likes->unlike($target_tweet_id);
    }

    /**
     * Retweets a tweet on behalf of the authenticated user
     *
     * @param string $target_tweet_id
     * @return object|exception
     */
    public function retweet($target_tweet_id)
    {
        return $this->retweets->retweet($target_tweet_id);
    }

    /**
     * Unretweets a tweet on behalf of the authenticated user
     *
     * @param string $target_tweet_id
     * @return object|exception
     */
    public function unretweet($target_tweet_id)
    {
        return $this->retweets->unretweet($target_tweet_id);
    }

    /**
     * User list actions - follow, unfolow, pin, unpin
     *
     * @return void
     */
    public function lists()
    {
        return new Lists($this->credentials, $this->username);
    }
}
