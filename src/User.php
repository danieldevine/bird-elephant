<?php

namespace Coderjerk\BirdElephant;

use Coderjerk\BirdElephant\Users\Follows;
use Coderjerk\BirdElephant\Users\Blocks;
use Coderjerk\BirdElephant\Users\Mutes;
use Coderjerk\BirdElephant\Users\Likes;
use Coderjerk\BirdElephant\Users\Retweets;
use Coderjerk\BirdElephant\Users\Lists;
use Coderjerk\BirdElephant\Spaces\SpacesLookup;
use Coderjerk\BirdElephant\Tweets\Timeline;
use Coderjerk\BirdElephant\Users\UserLookup;
use Coderjerk\BirdElephant\Users\Bookmarks;
use GuzzleHttp\Exception\GuzzleException;


class User
{
    protected array $credentials;
    private string $username;
    private UserLookup $userLookup;
    private Follows $follows;
    private Blocks $blocks;
    private Mutes $mutes;
    private Likes $likes;
    private Retweets $retweets;
    private SpacesLookup $spaces;
    private Timeline $timeline;
    private Bookmarks $bookmarks;

    public function __construct($credentials, $username)
    {
        $this->credentials = $credentials;
        $this->username = $username;
        $this->userLookup = new UserLookup($this->credentials, $this->username);
        $this->follows = new Follows($this->credentials, $this->username);
        $this->blocks = new Blocks($this->credentials, $this->username);
        $this->mutes = new Mutes($this->credentials, $this->username);
        $this->likes = new Likes($this->credentials, $this->username);
        $this->bookmarks = new Bookmarks($this->credentials, $this->username);
        $this->retweets = new Retweets($this->credentials, $this->username);
        $this->spaces = new SpacesLookup($this->credentials);
        $this->timeline = new Timeline($this->credentials);
    }

    /**
     * Gets a Twitter user by username
     *
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function get(array $params = []): object
    {
        return $this->userLookup->getSingleUserByUsername($this->username, $params);
    }

    /**
     * Gets a Twitter user's followers
     *
     * @param array $params
     * @return object
     */
    public function followers(array $params = []): object
    {
        return $this->follows->getFollowers($params);
    }

    /**
     * Gets a Twitter user's followed accounts
     *
     * @param array $params
     * @return object
     */
    public function following(array $params = []): object
    {
        return $this->follows->getFollowing($params);
    }

    /**
     * Follows a given user
     *
     * @param string $target_username the user to follow
     * @return object
     * @throws GuzzleException
     */
    public function follow(string $target_username): object
    {
        return $this->follows->follow($target_username);
    }

    /**
     * Unfollows a given user
     *
     * @param string $target_username the user to unfollow
     * @return object
     * @throws GuzzleException
     */
    public function unfollow(string $target_username): object
    {
        return $this->follows->unfollow($target_username);
    }

    /**
     * Gets the blocked accounts of a Twitter user.
     *
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function blocks($params = []): object
    {
        return $this->blocks->lookup($params);
    }

    /**
     * Blocks a given user
     *
     * @param string $target_username the user name to block
     * @return object
     * @throws GuzzleException
     */
    public function block(string $target_username): object
    {
        return $this->blocks->block($target_username);
    }

    /**
     * Unblocks a given user
     *
     * @param string $target_username the username to unblock
     * @return object
     * @throws GuzzleException
     */
    public function unblock(string $target_username): object
    {
        return $this->blocks->unblock($target_username);
    }

    /**
     * Gets the muted accounts of a Twitter user.
     *
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function mutes(array $params = []): object
    {
        return $this->mutes->lookup($params);
    }

    /**
     * Mutes a given user
     *
     * @param string $target_username the user to mute
     * @return object
     * @throws GuzzleException
     */
    public function mute(string $target_username): object
    {
        return $this->mutes->mute($target_username);
    }

    /**
     * Un-mutes a given user
     *
     * @param string $target_username the user to unmute
     * @return object
     * @throws GuzzleException
     */
    public function unmute(string $target_username): object
    {
        return $this->mutes->unmute($target_username);
    }

    /**
     * Gets the named user's last 100 likes
     *
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function likes(array $params = []): object
    {
        return $this->likes->lookup($params);
    }

    /**
     * Likes a tweet on behalf of the authenticated user
     *
     * @param string $target_tweet_id
     * @return object
     * @throws GuzzleException
     */
    public function like(string $target_tweet_id): object
    {
        return $this->likes->like($target_tweet_id);
    }

    /**
     * Unlikes a tweet on behalf of the authenticated user
     *
     * @param string $target_tweet_id
     * @return object
     * @throws GuzzleException
     */
    public function unlike(string $target_tweet_id): object
    {
        return $this->likes->unlike($target_tweet_id);
    }

    /**
     * Retweets a tweet on behalf of the authenticated user
     *
     * @param string $target_tweet_id
     * @return object
     * @throws GuzzleException
     */
    public function retweet(string $target_tweet_id): object
    {
        return $this->retweets->retweet($target_tweet_id);
    }

    /**
     * Unretweets a tweet on behalf of the authenticated user
     *
     * @param string $target_tweet_id
     * @return object
     * @throws GuzzleException
     */
    public function unretweet(string $target_tweet_id): object
    {
        return $this->retweets->unretweet($target_tweet_id);
    }

    /**
     * User list actions - follow, unfollow, pin, unpin
     *
     * @return Lists
     */
    public function lists(): Lists
    {
        return new Lists($this->credentials, $this->username);
    }

    /**
     * Gets a user's spaces
     *
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function spaces(array $params = []): object
    {
        return $this->spaces->getByUser($this->username, $params);
    }

    /**
     * Gets a user's tweets
     *
     * @param array $params
     * @return object
     */
    public function tweets(array $params = []): object
    {
        return $this->timeline->getTweets($this->username, $params);
    }

    /**
     * Gets a user's mentions.
     *
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function mentions(array $params = []): object
    {
        return $this->timeline->getMentions($this->username, $params);
    }

    /**
     * Gets a user's timeline
     * in reverse chronological order.
     *
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function timeline(array $params = []): object
    {
        return $this->timeline->getReverseChronological($this->username, $params);
    }

    /**
     * Gets the authenticated user's bookmarks
     *
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function bookmarks(array $params = []): object
    {
        return $this->bookmarks->lookup($params);
    }

    /**
     * bookmarks a tweet on behalf of the authenticated user
     *
     * @param string $target_tweet_id
     * @return object
     * @throws GuzzleException
     */
    public function bookmark(string $target_tweet_id): object
    {
        return $this->bookmarks->bookmark($target_tweet_id);
    }

    /**
     * Unbookmarks a tweet on behalf of the authenticated user
     *
     * @param string $target_tweet_id
     * @return object
     * @throws GuzzleException
     */
    public function unbookmark(string $target_tweet_id): object
    {
        return $this->bookmarks->unbookmark($target_tweet_id);
    }
}
