<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidRgbaColorException;
use PHPUnit\Framework\TestCase;

class InvalidRgbaColorExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function exception_throws_proper_message(): void
    {
        $this->expectException(InvalidRgbaColorException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Invalid RGBA color value. `moo` provided');

        throw new InvalidRgbaColorException('moo');
    }
}
