<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidRgbChannelException;

/**
 * Class InvalidRgbChannelExceptionTest
 *
 * @package Gubler\Color\Test\Exception
 */
class InvalidRgbChannelExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidRgbChannelException
     * @expectedExceptionCode 500
     * @expectedExceptionMessage Invalid RGB channel value. Only values between 0 and 255 allowed. `300` provided
     */
    public function exception_throws_proper_message()
    {
        throw new InvalidRgbChannelException(300);
    }
}
