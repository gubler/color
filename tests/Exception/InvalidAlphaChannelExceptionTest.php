<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidAlphaChannelException;

/**
 * Class InvalidAlphaChannelExceptionTest
 *
 * @package Gubler\Color\Test\Exception
 */
class InvalidAlphaChannelExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException Gubler\Color\Exception\InvalidAlphaChannelException
     * @expectedExceptionCode 500
     * @expectedExceptionMessage Invalid alpha channel value. Only values between 0 and 1 allowed. `2` provided
     */
    public function exception_throws_proper_message()
    {
        throw new InvalidAlphaChannelException(2);
    }
}
