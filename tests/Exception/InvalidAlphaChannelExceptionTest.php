<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidAlphaChannelException;
use PHPUnit\Framework\TestCase;

class InvalidAlphaChannelExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function exception_throws_proper_message(): void
    {
        $this->expectException(InvalidAlphaChannelException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Invalid alpha channel value. Only values between 0 and 1 allowed. `2` provided');

        throw new InvalidAlphaChannelException(2);
    }
}
