<?php

namespace Coderjerk\BirdElephant\Tweet;

class Poll
{
    // "poll": {"options": ["yes", "maybe", "no"], "duration_minutes": 120}}'
    protected int $duration_minutes;
    protected array $options;
}
