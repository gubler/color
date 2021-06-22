<?php

namespace Gubler\Color\Test;

use Gubler\Color\Color;
use PHPUnit\Framework\TestCase;

class ColorTest extends TestCase
{
    protected Color $color;

    public function setUp(): void
    {
        // rgb(18, 49, 35)
        // hsl(153, 46%, 13%)
        $this->color = new Color('#123123');
    }

    /** @test */
    public function can_instantiate_class(): void
    {
        self::assertInstanceOf(Color::class, $this->color);
    }

    /** @test */
    public function as_string_returns_rgba(): void
    {
        $this->assertEquals('rgba(18, 49, 35, 1)', (string) $this->color);
    }

    /** @test */
    public function rgba_returns_rgba(): void
    {
        $this->assertEquals('rgba(18, 49, 35, 1)', $this->color->rgba());
    }

    /** @test */
    public function rgb_returns_rgb(): void
    {
        $this->assertEquals('rgb(18, 49, 35)', $this->color->rgb());
    }

    /** @test */
    public function hsla_returns_hsla(): void
    {
        $this->assertEquals('hsla(153, 46%, 13%, 1)', $this->color->hsla());
    }

    /** @test */
    public function hsl_returns_hsl(): void
    {
        $this->assertEquals('hsl(153, 46%, 13%)', $this->color->hsl());
    }

    /** @test */
    public function hex_returns_hex(): void
    {
        $this->assertEquals('#123123', $this->color->hex());
    }

    /** @test */
    public function set_rgba_updates_color(): void
    {
        $this->color->setRgba(50, 100, 150);

        self::assertEquals('rgba(50, 100, 150, 1)', $this->color->rgba());
        self::assertEquals('#326496', $this->color->hex());
        self::assertEquals('hsla(210, 50%, 39%, 1)', $this->color->hsla());
    }

    /** @test */
    public function set_hsla_updates_color(): void
    {
        $this->color->setHsla(210, 50, 39, 1);

        self::assertEquals('rgba(50, 99, 149, 1)', $this->color->rgba());
        self::assertEquals('#326395', $this->color->hex());
        self::assertEquals('hsla(210, 50%, 39%, 1)', $this->color->hsla());
    }

    /** @test */
    public function set_hex_updates_color(): void
    {
        $this->color->setHex('#326496');

        self::assertEquals('rgba(50, 100, 150, 1)', $this->color->rgba());
        self::assertEquals('#326496', $this->color->hex());
        self::assertEquals('hsla(210, 50%, 39%, 1)', $this->color->hsla());
    }

    /** @test */
    public function calculates_contrast_text_color(): void
    {
        $this->color->setHex('#ef4444');
        self::assertEquals('#FFFFFF', $this->color->contrastTextColor()->hex());

        $this->color->setHex('#009f75');
        self::assertEquals('#FFFFFF', $this->color->contrastTextColor()->hex());

        $this->color->setHex('#394ba0');
        self::assertEquals('#FFFFFF', $this->color->contrastTextColor()->hex());

        $this->color->setHex('#d54799');
        self::assertEquals('#FFFFFF', $this->color->contrastTextColor()->hex());

        $this->color->setHex('#faa31b');
        self::assertEquals('#000000', $this->color->contrastTextColor()->hex());

        $this->color->setHex('#88c6ed');
        self::assertEquals('#000000', $this->color->contrastTextColor()->hex());

        $this->color->setHex('#fff000');
        self::assertEquals('#000000', $this->color->contrastTextColor()->hex());

        $this->color->setHex('#82c341');
        self::assertEquals('#000000', $this->color->contrastTextColor()->hex());
    }
}
