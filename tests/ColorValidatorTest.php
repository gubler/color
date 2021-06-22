<?php

namespace Gubler\Color\Test;

use Gubler\Color\ColorValidator;
use Gubler\Color\Exception\InvalidAlphaChannelException;
use Gubler\Color\Exception\InvalidHexChannelException;
use Gubler\Color\Exception\InvalidHexColorException;
use Gubler\Color\Exception\InvalidHslaColorException;
use Gubler\Color\Exception\InvalidHslColorException;
use Gubler\Color\Exception\InvalidHueChannelException;
use Gubler\Color\Exception\InvalidPercentChannelException;
use Gubler\Color\Exception\InvalidRgbaColorException;
use Gubler\Color\Exception\InvalidRgbChannelException;
use Gubler\Color\Exception\InvalidRgbColorException;
use PHPUnit\Framework\TestCase;

class ColorValidatorTest extends TestCase
{
    protected ColorValidator $validator;

    public function setUp(): void
    {
        $this->validator = new ColorValidator();
    }

    // ----------------------------------------
    // ::check tests
    // ----------------------------------------

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::check
     */
    public function check_matches_valid_colors(): void
    {
        self::assertTrue($this->validator->check('rgb(1,1,1)'));
        self::assertTrue($this->validator->check('rgb(1%,1%,1%)'));
        self::assertTrue($this->validator->check('rgba(1,1,1,1)'));
        self::assertTrue($this->validator->check('rgba(1%,1%,1%,0.1)'));
        self::assertTrue($this->validator->check('#123456'));
        self::assertTrue($this->validator->check('#abc'));
        self::assertTrue($this->validator->check('hsl(1,1%,1%)'));
        self::assertTrue($this->validator->check('hsla(1,1%,1%,0.1)'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::check
     */
    public function check_errors_invalid_colors(): void
    {
        self::assertFalse($this->validator->check('moo'));
        self::assertFalse($this->validator->check('rgb(1)'));
        self::assertFalse($this->validator->check('hsl(2)'));
        self::assertFalse($this->validator->check('rgba(1)'));
        self::assertFalse($this->validator->check('rgba(1)'));
        self::assertFalse($this->validator->check('#1'));
        self::assertFalse($this->validator->check('#1234'));
    }

    // ----------------------------------------
    // Channel tests
    // ----------------------------------------

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::hexChannel
     */
    public function hex_channel_matches_hex_value(): void
    {
        self::assertTrue($this->validator->hexChannel('FF'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::hexChannel
     */
    public function hex_channel_errors_invalid_hex_value(): void
    {
        $this->expectException(InvalidHexChannelException::class);

        $this->validator->hexChannel('moo');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::rgbChannel
     */
    public function rgb_channel_matches_rgb_value(): void
    {
        self::assertTrue($this->validator->rgbChannel(100));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::rgbChannel
     */
    public function rgb_channel_errors_invalid_rgb_value(): void
    {
        $this->expectException(InvalidRgbChannelException::class);

        $this->validator->rgbChannel(256);
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::alphaChannel
     */
    public function alpha_channel_matches_alpha_value(): void
    {
        self::assertTrue($this->validator->alphaChannel(1));
        self::assertTrue($this->validator->alphaChannel(0));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::alphaChannel
     */
    public function alpha_channel_errors_invalid_alpha_value(): void
    {
        $this->expectException(InvalidAlphaChannelException::class);
        $this->validator->alphaChannel(1.1);
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::percentChannel
     */
    public function percent_channel_matches_percent_value(): void
    {
        self::assertTrue($this->validator->percentChannel('100%'));
        self::assertTrue($this->validator->percentChannel('0%'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::percentChannel
     */
    public function percent_channel_errors_invalid_percent(): void
    {
        $this->expectException(InvalidPercentChannelException::class);
        $this->validator->percentChannel('a');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::hueChannel
     */
    public function hue_channel_matches_hue_value(): void
    {
        self::assertTrue($this->validator->hueChannel(135.33433));
        self::assertTrue($this->validator->hueChannel((float) -10));
        self::assertTrue($this->validator->hueChannel(10.5));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::hueChannel
     */
    public function hue_channel_errors_invalid_hue(): void
    {
        $this->expectException(InvalidHueChannelException::class);
        $this->validator->hueChannel('m');
    }

    // ----------------------------------------
    // Color tests
    // ----------------------------------------

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::hex
     */
    public function hex_matches_hex_color(): void
    {
        self::assertTrue($this->validator->hex('#abcdef'));
        self::assertTrue($this->validator->hex('#123456'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::hex
     */
    public function hex_errors_invalid_hex_color(): void
    {
        $this->expectException(InvalidHexColorException::class);
        $this->validator->hex('#FFF');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::shortHex
     */
    public function short_hex_matches_short_hex_color(): void
    {
        self::assertTrue($this->validator->shortHex('#fff'));
        self::assertTrue($this->validator->shortHex('#1A1'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::shortHex
     */
    public function short_hex_errors_invalid_short_hex_color(): void
    {
        $this->expectException(InvalidHexColorException::class);
        $this->validator->shortHex('#FFFfff');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::rgb
     */
    public function rgb_matches_rgb_color(): void
    {
        self::assertTrue($this->validator->rgb('rgb(1,1,1)'));
        self::assertTrue($this->validator->rgb('rgb(0,255,0)'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::rgb
     */
    public function rgb_errors_invalid_rgb_color(): void
    {
        $this->expectException(InvalidRgbColorException::class);
        $this->validator->rgb('rg(0,0,1000)');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::rgba
     */
    public function rgba_matches_rgba_color(): void
    {
        self::assertTrue($this->validator->rgba('rgba(1,1,1,0.2)'));
        self::assertTrue($this->validator->rgba('rgba(0,255,0,1)'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::rgba
     */
    public function rgba_errors_invalid_rgba_color(): void
    {
        $this->expectException(InvalidRgbaColorException::class);
        $this->validator->rgba('rgb(0,0,100,3)');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::rgbPercent
     */
    public function rgb_percent_matches_rgb_percent_color(): void
    {
        self::assertTrue($this->validator->rgbPercent('rgb(1%,1%,1%)'));
        self::assertTrue($this->validator->rgbPercent('rgb(0%,100%,0%)'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::rgbPercent
     */
    public function rgb_percent_errors_invalid_rgb_percent_color(): void
    {
        $this->expectException(InvalidRgbColorException::class);
        $this->validator->rgbPercent('rg(0,0,1000)');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::rgbaPercent
     */
    public function rgba_percent_matches_rgba_percent_color(): void
    {
        self::assertTrue($this->validator->rgbaPercent('rgba(1%,1%,1%,0.2)'));
        self::assertTrue($this->validator->rgbaPercent('rgba(0%,100%,0%,1)'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::rgbaPercent
     */
    public function rgba_percent_errors_invalid_rgba_percent_color(): void
    {
        $this->expectException(InvalidRgbaColorException::class);
        $this->validator->rgbaPercent('rg(0,0,100,3)');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::hsl
     */
    public function hsl_matches_hsl_color(): void
    {
        self::assertTrue($this->validator->hsl('hsl(1.5,1%,1%)'));
        self::assertTrue($this->validator->hsl('hsl(100.344,50%,5%)'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::hsl
     */
    public function hsl_errors_invalid_hsl_color(): void
    {
        $this->expectException(InvalidHslColorException::class);
        $this->validator->hsl('moo');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::hsla
     */
    public function hsla_matches_hsla_color(): void
    {
        self::assertTrue($this->validator->hsla('hsla(123.32,1%,100%,0.2)'));
        self::assertTrue($this->validator->hsla('hsla(0,55%,0%,1)'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::hsla
     */
    public function hsla_errors_invalid_hsla_color(): void
    {
        $this->expectException(InvalidHslaColorException::class);
        $this->validator->hsla('moo');
    }
}
