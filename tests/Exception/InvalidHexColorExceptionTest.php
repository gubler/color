<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidHexColorException;

/**
 * Class InvalidHexColorExceptionTest.
 */
class InvalidHexColorExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidHexColorException
     * @expectedExceptionCode 500
     * @expectedExceptionMessage Invalid hex color value. Value must start with # followed by 3 or 6 characters. `YYYY` provided
     */
    public function exception_throws_proper_message()
    {
        throw new InvalidHexColorException('YYYY');
    }
}
