<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidColorException;

/**
 * Class InvalidColorExceptionTest
 *
 * @package Gubler\Color\Test\Exception
 */
class InvalidColorExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException Gubler\Color\Exception\InvalidColorException
     * @expectedExceptionCode 500
     * @expectedExceptionMessage Invalid Color Provided
     */
    public function exception_throws_default_message_and_code()
    {
        throw new InvalidColorException();
    }

    /**
     * @test
     * @expectedException Gubler\Color\Exception\InvalidColorException
     * @expectedExceptionCode 500
     * @expectedExceptionMessage Moo
     */
    public function exception_throws_custom_message()
    {
        throw new InvalidColorException('Moo');
    }

    /**
     * @test
     * @expectedException Gubler\Color\Exception\InvalidColorException
     * @expectedExceptionCode 501
     * @expectedExceptionMessage Invalid Color Provided
     */
    public function exception_throws_custom_code()
    {
        throw new InvalidColorException('Invalid Color Provided', 501);
    }
}
