<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidHslColorException;

/**
 * Class InvalidHslColorExceptionTest.
 */
class InvalidHslColorExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidHslColorException
     * @expectedExceptionCode 500
     * @expectedExceptionMessage Invalid HSL color value. `YYYY` provided.
     */
    public function exception_throws_proper_message()
    {
        throw new InvalidHslColorException('YYYY');
    }
}
