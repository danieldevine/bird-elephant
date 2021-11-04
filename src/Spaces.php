<?php

namespace Coderjerk\BirdElephant;

use Coderjerk\BirdElephant\Spaces\SpacesLookup;

/**
 * "Spaces is a new way to have live audio conversations on Twitter."
 *
 * https://help.twitter.com/en/using-twitter/spaces
 */
class Spaces
{
    /**
     * Tokens and secrets
     *
     * @var array
     */
    protected array $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    public function lookup()
    {
        return new SpacesLookup($this->credentials);
    }
}
