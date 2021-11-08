<?php

namespace Coderjerk\BirdElephant\Compose;

/**
 *
 */
class Geo
{
    public ?string $place_id = null;

    public function placeId($place_id)
    {
        $this->place_id = $place_id;
        return $this;
    }
}
