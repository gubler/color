<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidRgbaColorException;

/**
 * Class InvalidRgbaColorExceptionTest
 *
 * @package Gubler\Color\Test\Exception
 */
class InvalidRgbaColorExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException Gubler\Color\Exception\InvalidRgbaColorException
     * @expectedExceptionCode 500
     * @expectedExceptionMessage Invalid RGBA color value. `moo` provided
     */
    public function exception_throws_proper_message()
    {
        throw new InvalidRgbaColorException('moo');
    }
}
