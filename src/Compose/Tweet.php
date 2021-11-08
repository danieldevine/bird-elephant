<?php

namespace Coderjerk\BirdElephant\Compose;

class Tweet
{
    public ?string $direct_message_deep_link = null;
    public bool $for_super_followers_only = false;
    public ?string $quote_tweet_id = null;
    public ?string $reply_settings = null;
    public ?string $text = null;
    public ?object $media = null;
    public ?object $poll = null;
    public ?object $reply = null;
    public ?object $geo = null;

    public function text($text)
    {
        $this->text = $text;
        return $this;
    }

    public function geo($geo)
    {
        $this->geo = $geo;
        return $this;
    }

    public function media($media)
    {
        if ($this->poll !== null || $this->quote_tweet_id !== null) {
            throw new Exception('A tweet can only contain one of a poll, media or a quote tweet id.');
        }
        $this->media = $media;
        return $this;
    }

    public function poll($poll)
    {
        if ($this->media !== null || $this->quote_tweet_id !== null) {
            throw new Exception('A tweet can only contain one of a poll, media or a quote tweet id.');
        }
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
        if ($this->media !== null || $this->poll !== null) {
            throw new Exception('A tweet can only cotain one of a poll, media or a quote tweet id.');
        }
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

    /**
     * Add all non null properties to an array
     *
     * @return array
     */
    public function build(): array
    {
        $vars =  get_object_vars($this);
        $data = [];

        foreach ($vars as $key => $value) {
            if ($value !== null) {
                $data[$key] = $value;
            }
        }

        return $data;
    }
}
