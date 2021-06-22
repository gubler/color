<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidColorException;
use PHPUnit\Framework\TestCase;

class InvalidColorExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function exception_throws_default_message_and_code(): void
    {
        $this->expectException(InvalidColorException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Invalid Color Provided');

        throw new InvalidColorException();
    }

    /**
     * @test
     */
    public function exception_throws_custom_message(): void
    {
        $this->expectException(InvalidColorException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Moo');

        throw new InvalidColorException('Moo');
    }

    /**
     * @test
     */
    public function exception_throws_custom_code(): void
    {
        $this->expectException(InvalidColorException::class);
        $this->expectExceptionCode(501);
        $this->expectExceptionMessage('Invalid Color Provided');

        throw new InvalidColorException('Invalid Color Provided', 501);
    }
}
