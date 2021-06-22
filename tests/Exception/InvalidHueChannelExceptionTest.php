<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidHueChannelException;
use PHPUnit\Framework\TestCase;

class InvalidHueChannelExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function exception_throws_proper_message(): void
    {
        $this->expectException(InvalidHueChannelException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Invalid hue channel value. Only float values allowed. `GG` provided');

        throw new InvalidHueChannelException('GG');
    }
}
