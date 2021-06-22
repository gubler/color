<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidHexColorException;
use PHPUnit\Framework\TestCase;

class InvalidHexColorExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function exception_throws_proper_message(): void
    {
        $this->expectException(InvalidHexColorException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Invalid hex color value. Value must start with # followed by 3 or 6 characters. `YYYY` provided');

        throw new InvalidHexColorException('YYYY');
    }
}
