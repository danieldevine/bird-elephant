<?php

namespace Coderjerk\ElephantBird\Tests;

use PHPUnit\Framework\TestCase;
use Coderjerk\ElephantBird\FilteredStream;

use function PHPUnit\Framework\assertIsArray;
use function PHPUnit\Framework\assertIsObject;

class FilteredStreamTest extends TestCase
{
    public function testCanDeleteAndWriteRules()
    {
        $filteredStream = new FilteredStream;

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
