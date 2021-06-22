<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidHslColorException;
use PHPUnit\Framework\TestCase;

class InvalidHslColorExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function exception_throws_proper_message(): void
    {
        $this->expectException(InvalidHslColorException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Invalid HSL color value. `YYYY` provided.');

        throw new InvalidHslColorException('YYYY');
    }
}
