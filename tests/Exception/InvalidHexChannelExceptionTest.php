<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidHexChannelException;
use PHPUnit\Framework\TestCase;

class InvalidHexChannelExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function exception_throws_proper_message(): void
    {
        $this->expectException(InvalidHexChannelException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Invalid hex channel value. Only values between 00 and FF allowed. `GG` provided');

        throw new InvalidHexChannelException('GG');
    }
}
