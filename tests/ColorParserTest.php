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
    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidColorException
     * @expectedExceptionMessage Unrecognized color. `moo` provided.
     * @covers \Gubler\Color\ColorParser
     */
    public function parse_throws_error_with_unrecognized_color()
    {
        ColorParser::parse('moo');
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidColorException
     * @expectedExceptionMessage Unrecognized color. `moo` provided.
     * @covers \Gubler\Color\ColorParser
     */
    public function color_type_throws_error_with_unrecognized_color()
    {
        ColorParser::colorType('moo');
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
     * @test
     * @covers \Gubler\Color\ColorParser
     */
    public function parses_rgb()
    {
        $color = [
            'red' => 10,
            'green' => 20,
            'blue' => 30,
            'alpha' => 1,
        ];
        $parser = new ColorParser('rgb(10,20,30)');
        self::assertInstanceOf(ColorParser::class, $parser);
        self::assertEquals($color, $parser->toRgbaArray());
        self::assertEquals($color, ColorParser::parse('rgb(10,20,30)'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorParser
     */
    public function parses_rgb_percent()
    {
        $color = [
            'red' => 128,
            'green' => 191,
            'blue' => 255,
            'alpha' => 1,
        ];
        $parser = new ColorParser('rgb(50%, 75%, 100%)');
        self::assertInstanceOf(ColorParser::class, $parser);
        self::assertEquals($color, $parser->toRgbaArray());
        self::assertEquals($color, ColorParser::parse('rgb(50%, 75%, 100%)'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorParser
     */
    public function parses_rgba()
    {
        $color = [
            'red' => 10,
            'green' => 20,
            'blue' => 30,
            'alpha' => 0.5,
        ];
        $parser = new ColorParser('rgba(10,20,30,.5)');
        self::assertInstanceOf(ColorParser::class, $parser);
        self::assertEquals($color, $parser->toRgbaArray());
        self::assertEquals($color, ColorParser::parse('rgba(10,20,30, .5)'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorParser
     */
    public function parses_rgba_percent()
    {
        $color = [
            'red' => 128,
            'green' => 191,
            'blue' => 255,
            'alpha' => 0.75,
        ];
        $parser = new ColorParser('rgba(50%, 75%, 100%, 0.75)');
        self::assertInstanceOf(ColorParser::class, $parser);
        self::assertEquals($color, $parser->toRgbaArray());
        self::assertEquals($color, ColorParser::parse('rgba(50%, 75%, 100%, 0.75)'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorParser
     */
    public function parses_hsl()
    {
        $color = [
            'red' => 64,
            'green' => 191,
            'blue' => 71,
            'alpha' => 1,
        ];
        $parser = new ColorParser('hsl(123.456, 50%, 50%)');
        self::assertInstanceOf(ColorParser::class, $parser);
        self::assertEquals($color, $parser->toRgbaArray());
        self::assertEquals($color, ColorParser::parse('hsl(123.456, 50%, 50%)'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorParser
     */
    public function parses_hsla()
    {
        $color = [
            'red' => 255,
            'green' => 0,
            'blue' => 43,
            'alpha' => 0.77,
        ];
        $parser = new ColorParser('hsla(350, 100%, 50%, 0.77)');
        self::assertInstanceOf(ColorParser::class, $parser);
        self::assertEquals($color, $parser->toRgbaArray());
        self::assertEquals($color, ColorParser::parse('hsla(350, 100%, 50%, 0.77)'));
    }
}
