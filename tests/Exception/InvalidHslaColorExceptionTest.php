<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidHslaColorException;
use PHPUnit\Framework\TestCase;

class InvalidHslaColorExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function exception_throws_proper_message(): void
    {
        $this->expectException(InvalidHslaColorException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Invalid HSLA color value. `YYYY` provided.');

        throw new InvalidHslaColorException('YYYY');
    }
}
