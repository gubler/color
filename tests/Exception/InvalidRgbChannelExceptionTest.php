<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidRgbChannelException;
use PHPUnit\Framework\TestCase;

class InvalidRgbChannelExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function exception_throws_proper_message(): void
    {
        $this->expectException(InvalidRgbChannelException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Invalid RGB channel value. Only values between 0 and 255 allowed. `300` provided');

        throw new InvalidRgbChannelException(300);
    }
}
