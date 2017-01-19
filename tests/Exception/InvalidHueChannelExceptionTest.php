<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidHueChannelException;

/**
 * Class InvalidHueChannelExceptionTest
 *
 * @package Gubler\Color\Test\Exception
 */
class InvalidHueChannelExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidHueChannelException
     * @expectedExceptionCode 500
     * @expectedExceptionMessage Invalid hue channel value. Only float values allowed. `GG` provided
     */
    public function exception_throws_proper_message()
    {
        throw new InvalidHueChannelException('GG');
    }

}
