<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidRgbColorException;

/**
 * Class InvalidRgbColorExceptionTest
 *
 * @package Gubler\Color\Test\Exception
 */
class InvalidRgbColorExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidRgbColorException
     * @expectedExceptionCode 500
     * @expectedExceptionMessage Invalid RGB color value. `moo` provided
     */
    public function exception_throws_proper_message()
    {
        throw new InvalidRgbColorException('moo');
    }
}
