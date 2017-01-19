<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidPercentChannelException;

/**
 * Class InvalidPercentChannelExceptionTest
 *
 * @package Gubler\Color\Test\Exception
 */
class InvalidPercentChannelExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidPercentChannelException
     * @expectedExceptionCode 500
     * @expectedExceptionMessage Invalid percent channel value. Only values 0%-100% allowed. `4` provided
     */
    public function exception_throws_proper_message()
    {
        throw new InvalidPercentChannelException(4);
    }

}
