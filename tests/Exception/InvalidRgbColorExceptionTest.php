<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidRgbColorException;
use PHPUnit\Framework\TestCase;

class InvalidRgbColorExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function exception_throws_proper_message(): void
    {
        $this->expectException(InvalidRgbColorException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Invalid RGB color value. `moo` provided');

        throw new InvalidRgbColorException('moo');
    }
}
