<?php

namespace Coderjerk\BirdElephant\Compose;

class Media
{
    public ?array $media_ids = null;
    public ?array $tagged_user_ids = [];

    public function mediaIds($media_ids)
    {
        $this->media_ids = $media_ids;
        return $this;
    }

    public function taggedUserIds($tagged_user_ids)
    {
        $this->tagged_user_ids = $tagged_user_ids;
        return $this;
    }
}
