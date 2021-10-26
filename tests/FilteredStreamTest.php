<?php

namespace Coderjerk\ElephantBird\Tests;

use PHPUnit\Framework\TestCase;
use Coderjerk\ElephantBird\Tweets\FilteredStream;

use function PHPUnit\Framework\assertIsArray;
use function PHPUnit\Framework\assertIsObject;

class FilteredStreamTest extends TestCase
{
    public function testCanDeleteAndWriteRules()
    {
        $credentials = array(
            'bearer_token' => $_ENV['TWITTER_BEARER_TOKEN'],
            'consumer_key' => $_ENV['TWITTER_API_KEY'],
            'consumer_secret' => $_ENV['TWITTER_SECRET'],
            'token_identifier' => $_ENV['TWITTER_ACCESS_TOKEN'],
            'token_secret' => $_ENV['TWITTER_ACCESS_TOKEN_SECRET'],
        );

        $filteredStream = new FilteredStream($credentials);

        //clear all rules
        $filteredStream->deleteAllRules();

        // set a rule
        $rules = $filteredStream->setRules('test', 'testing is fun');
        $rule = $rules->data[0];

        assertIsArray($rules->data);

        assertIsObject($rule);

        $filteredStream->deleteAllRules();
    }
}
