<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidHexChannelException;

/**
 * Class InvalidHexChannelExceptionTest
 *
 * @package Gubler\Color\Test\Exception
 */
class InvalidHexChannelExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException Gubler\Color\Exception\InvalidHexChannelException
     * @expectedExceptionCode 500
     * @expectedExceptionMessage Invalid hex channel value. Only values between 00 and FF allowed. `GG` provided
     */
    public function exception_throws_proper_message()
    {
        throw new InvalidHexChannelException('GG');
    }

}
