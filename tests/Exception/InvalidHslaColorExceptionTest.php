<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidHslaColorException;

/**
 * Class InvalidHslaColorExceptionTest
 *
 * @package Gubler\Color\Test\Exception
 */
class InvalidHslaColorExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidHslaColorException
     * @expectedExceptionCode 500
     * @expectedExceptionMessage Invalid HSLA color value. `YYYY` provided.
     */
    public function exception_throws_proper_message()
    {
        throw new InvalidHslaColorException('YYYY');
    }
}
