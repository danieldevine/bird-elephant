<?php

namespace Coderjerk\BirdElephant\Compose;

class Poll
{
    // "poll": {"options": ["yes", "maybe", "no"], "duration_minutes": 120}}'
    public ?int $duration_minutes = null;
    public array $options;
}
