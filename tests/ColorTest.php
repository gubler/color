<?php

namespace Gubler\Color\Test;

use Gubler\Color\Color;

/**
 * Class ColorTest
 *
 * @package Gubler\Color\Test
 */
class ColorTest extends \PHPUnit_Framework_TestCase
{
    /** @var Color */
    protected $color;

    /** set up */
    public function setUp()
    {
        // rgb(18, 49, 35)
        // hsl(153, 46%, 13%)
        $this->color = new Color('#123123');

    }

    /** @test */
    public function can_instantiate_class()
    {
        self::assertInstanceOf(Color::class, $this->color);
    }

    /** @test */
    public function as_string_returns_rgba()
    {
        $this->assertEquals('rgba(18, 49, 35, 1)', (string) $this->color);
    }

    /** @test */
    public function rgba_returns_rgba()
    {
        $this->assertEquals('rgba(18, 49, 35, 1)', $this->color->rgba());
    }

    /** @test */
    public function rgb_returns_rgb()
    {
        $this->assertEquals('rgb(18, 49, 35)', $this->color->rgb());
    }

    /** @test */
    public function hsla_returns_hsla()
    {
        $this->assertEquals('hsla(153, 46%, 13%, 1)', $this->color->hsla());
    }

    /** @test */
    public function hsl_returns_hsl()
    {
        $this->assertEquals('hsl(153, 46%, 13%)', $this->color->hsl());
    }

    /** @test */
    public function hex_returns_hex()
    {
        $this->assertEquals('#123123', $this->color->hex());
    }

    /** @test */
    public function set_rgba_updates_color()
    {
        $this->color->setRgba(50, 100, 150, 1.0);

        self::assertEquals('rgba(50, 100, 150, 1)', $this->color->rgba());
        self::assertEquals('#326496', $this->color->hex());
        self::assertEquals('hsla(210, 50%, 39%, 1)', $this->color->hsla());
    }

    /** @test */
    public function set_hsla_updates_color()
    {
        $this->color->setHsla(210, 50, 39, 1);

        self::assertEquals('rgba(50, 99, 149, 1)', $this->color->rgba());
        self::assertEquals('#326395', $this->color->hex());
        self::assertEquals('hsla(210, 50%, 39%, 1)', $this->color->hsla());
    }

    /** @test */
    public function set_hex_updates_color()
    {
        $this->color->setHex('#326496');

        self::assertEquals('rgba(50, 100, 150, 1)', $this->color->rgba());
        self::assertEquals('#326496', $this->color->hex());
        self::assertEquals('hsla(210, 50%, 39%, 1)', $this->color->hsla());
    }
}
