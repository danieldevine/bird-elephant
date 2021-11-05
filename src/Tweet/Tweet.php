<?php

namespace Coderjerk\BirdElephant\Tweet;

use Coderjerk\BirdElephant\ApiBase;

class Tweet extends ApiBase
{
    protected string $direct_message_deep_link;
    protected bool   $for_super_followers_only = false;
    protected string $geo_place_id;
    protected string $quote_tweet_id;
    protected string $reply_settings;
    protected string $text;
    protected object $media;
    protected object $poll;
    protected object $reply;

    public function text($text)
    {
        $this->text = $text;
        return $this;
    }

    public function media($media)
    {
        $this->media = $media;
        return $this;
    }

    public function poll($poll)
    {
        $this->poll = $poll;
        return $this;
    }

    public function reply($reply)
    {
        $this->reply = $reply;
        return $this;
    }

    public function replySettings($reply_settings)
    {
        $this->reply_settings = $reply_settings;
        return $this;
    }

    public function quoteTweetId($quote_tweet_id)
    {
        $this->quote_tweet_id = $quote_tweet_id;
        return $this;
    }

    public function forSuperFollowersOnly($for_super_followers_only = true)
    {
        $this->for_super_followers_only = $for_super_followers_only;
        return $this;
    }

    public function directMessageDeepLink($direct_message_deep_link)
    {
        $this->direct_message_deep_link = $direct_message_deep_link;
        return $this;
    }

    public function send()
    {
        $data = [];
    }
}
