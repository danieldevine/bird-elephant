<?php

namespace Coderjerk\BirdElephant\Compose;

class Reply
{
    public ?array $exclude_reply_user_ids = [];
    public string $in_reply_to_tweet_id;

    public function excludeReplyUserIds($exclude_reply_user_ids)
    {
        $this->exclude_reply_user_ids = $exclude_reply_user_ids;
        return $this;
    }

    public function inReplyToTweetId($in_reply_to_tweet_id)
    {
        $this->in_reply_to_tweet_id = $in_reply_to_tweet_id;
        return $this;
    }
}
