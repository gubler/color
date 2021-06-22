<?php

namespace Gubler\Color\Test\Exception;

use Gubler\Color\Exception\InvalidPercentChannelException;
use PHPUnit\Framework\TestCase;

class InvalidPercentChannelExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function exception_throws_proper_message(): void
    {
        $this->expectException(InvalidPercentChannelException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Invalid percent channel value. Only values 0%-100% allowed. `4` provided');

        throw new InvalidPercentChannelException(4);
    }
}
