<?php

namespace Gubler\Color\Test;

use Gubler\Color\ColorParser;
use Gubler\Color\Exception\InvalidColorException;
use PHPUnit\Framework\TestCase;

class ColorParserTest extends TestCase
{
    protected ColorParser $parser;

    public function setUp(): void
    {
        $this->parser = new ColorParser();
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorParser
     */
    public function parse_throws_error_with_unrecognized_color(): void
    {
        $this->expectException(InvalidColorException::class);
        $this->expectExceptionMessage('Unrecognized color. `moo` provided.');

        $this->parser->parse('moo');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorParser
     */
    public function color_type_throws_error_with_unrecognized_color(): void
    {
        $this->expectException(InvalidColorException::class);
        $this->expectExceptionMessage('Unrecognized color. `moo` provided.');

        $this->parser->colorType('moo');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorParser
     */
    public function parses_short_hex(): void
    {
        $color = [
            'red' => 17,
            'green' => 34,
            'blue' => 51,
            'alpha' => 1,
        ];
        $parser = new ColorParser('#123');
        self::assertEquals($color, $parser->toArray());
        self::assertEquals($color, $this->parser->parse('#123')->toArray());
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorParser
     */
    public function parses_hex(): void
    {
        $color = [
            'red' => 171,
            'green' => 205,
            'blue' => 239,
            'alpha' => 1,
        ];
        $parser = new ColorParser('#abcdef');
        self::assertEquals($color, $parser->toArray());
        self::assertEquals($color, $this->parser->parse('#abcdef')->toArray());
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorParser
     */
    public function parses_rgb(): void
    {
        $color = [
            'red' => 10,
            'green' => 20,
            'blue' => 30,
            'alpha' => 1,
        ];
        $parser = new ColorParser('rgb(10,20,30)');
        self::assertEquals($color, $parser->toArray());
        self::assertEquals($color, $this->parser->parse('rgb(10,20,30)')->toArray());
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorParser
     */
    public function parses_rgb_percent(): void
    {
        $color = [
            'red' => 128,
            'green' => 191,
            'blue' => 255,
            'alpha' => 1,
        ];
        $parser = new ColorParser('rgb(50%, 75%, 100%)');
        self::assertEquals($color, $parser->toArray());
        self::assertEquals($color, $this->parser->parse('rgb(50%, 75%, 100%)')->toArray());
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorParser
     */
    public function parses_rgba(): void
    {
        $color = [
            'red' => 10,
            'green' => 20,
            'blue' => 30,
            'alpha' => 0.5,
        ];
        $parser = new ColorParser('rgba(10,20,30,.5)');
        self::assertEquals($color, $parser->toArray());
        self::assertEquals($color, $this->parser->parse('rgba(10,20,30, .5)')->toArray());
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorParser
     */
    public function parses_rgba_percent(): void
    {
        $color = [
            'red' => 128,
            'green' => 191,
            'blue' => 255,
            'alpha' => 0.75,
        ];
        $parser = new ColorParser('rgba(50%, 75%, 100%, 0.75)');
        self::assertEquals($color, $parser->toArray());
        self::assertEquals($color, $this->parser->parse('rgba(50%, 75%, 100%, 0.75)')->toArray());
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorParser
     */
    public function parses_hsl(): void
    {
        $color = [
            'red' => 64,
            'green' => 191,
            'blue' => 71,
            'alpha' => 1,
        ];
        $parser = new ColorParser('hsl(123.456, 50%, 50%)');
        self::assertEquals($color, $parser->toArray());
        self::assertEquals($color, $this->parser->parse('hsl(123.456, 50%, 50%)')->toArray());
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorParser
     */
    public function parses_hsla(): void
    {
        $color = [
            'red' => 255,
            'green' => 0,
            'blue' => 43,
            'alpha' => 0.77,
        ];
        $parser = new ColorParser('hsla(350, 100%, 50%, 0.77)');
        self::assertInstanceOf(ColorParser::class, $parser);
        self::assertEquals($color, $parser->toArray());
        self::assertEquals($color, $this->parser->parse('hsla(350, 100%, 50%, 0.77)')->toArray());
    }
}
