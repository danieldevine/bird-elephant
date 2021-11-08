<?php

namespace Coderjerk\BirdElephant\Compose;

class Media
{
    public ?array $media_ids = null;
    public ?array $tagged_user_ids = [];

    public function mediaIds($media_ids): static
    {
        $this->media_ids = $media_ids;
        return $this;
    }

    public function taggedUserIds($tagged_user_ids): static
    {
        $this->tagged_user_ids = $tagged_user_ids;
        return $this;
    }
}
