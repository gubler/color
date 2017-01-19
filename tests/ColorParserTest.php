<?php

namespace Gubler\Color\Test;

use Gubler\Color\ColorParser;

/**
 * Class ColorParserTest
 *
 * @package Gubler\Color\Test
 */
class ColorParserTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function not_implemented()
    {
        self::markTestIncomplete();
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorParser
     */
    public function parses_short_hex()
    {
        $color = [
            'red' => 17,
            'green' => 34,
            'blue' => 51,
            'alpha' => 1,
        ];
        $parser = new ColorParser('#123');
        self::assertInstanceOf(ColorParser::class, $parser);
        self::assertEquals($color, $parser->toRgbaArray());
        self::assertEquals($color, ColorParser::parse('#123'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorParser
     */
    public function parses_hex()
    {
        $color = [
            'red' => 171,
            'green' => 205,
            'blue' => 239,
            'alpha' => 1,
        ];
        $parser = new ColorParser('#abcdef');
        self::assertInstanceOf(ColorParser::class, $parser);
        self::assertEquals($color, $parser->toRgbaArray());
        self::assertEquals($color, ColorParser::parse('#abcdef'));
    }

    /**
     * @covers \Gubler\Color\ColorParser
     */
    public function holder()
    {
        self::assertInstanceOf(ColorParser::class, new ColorParser('rgb(1,2,3)'));
        self::assertInstanceOf(ColorParser::class, new ColorParser('rgb(10%,20%,30%)'));
        self::assertInstanceOf(ColorParser::class, new ColorParser('rgba(7,8,9,0.1)'));
        self::assertInstanceOf(ColorParser::class, new ColorParser('rgba(70%,80%,90%,1)'));
        self::assertInstanceOf(ColorParser::class, new ColorParser('hsl(123.456,25%,25%)'));
        self::assertInstanceOf(ColorParser::class, new ColorParser('hsla(350,75%,100%,.77)'));
    }
}
