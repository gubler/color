<?php

namespace Gubler\Color\Test;

use Gubler\Color\ColorValidator;

/**
 * Class ColorValidatorTest
 *
 * @package Gubler\Color\Test
 */
class ColorValidatorTest extends \PHPUnit_Framework_TestCase
{
    // ----------------------------------------
    // ::check tests
    // ----------------------------------------

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::check
     */
    public function check_matches_valid_colors()
    {
        $validator = new ColorValidator();

        self::assertTrue($validator->check('rgb(1,1,1)'));
        self::assertTrue($validator->check('rgb(1%,1%,1%)'));
        self::assertTrue($validator->check('rgba(1,1,1,1)'));
        self::assertTrue($validator->check('rgba(1%,1%,1%,0.1)'));
        self::assertTrue($validator->check('#123456'));
        self::assertTrue($validator->check('#abc'));
        self::assertTrue($validator->check('hsl(1,1%,1%)'));
        self::assertTrue($validator->check('hsla(1,1%,1%,0.1)'));


        self::assertTrue(ColorValidator::check('rgb(1,1,1)'));
        self::assertTrue(ColorValidator::check('rgba(1,1,1,1)'));
        self::assertTrue(ColorValidator::check('rgb(1%,1%,1%)'));
        self::assertTrue(ColorValidator::check('rgba(1%,1%,1%,1)'));
        self::assertTrue(ColorValidator::check('#123456'));
        self::assertTrue(ColorValidator::check('#abc'));
        self::assertTrue(ColorValidator::check('hsl(1,1%,1%)'));
        self::assertTrue(ColorValidator::check('hsla(1,1%,1%,0.1)'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::check
     */
    public function check_errors_invalid_colors()
    {
        $validator = new ColorValidator();

        self::assertFalse($validator->check('moo'));
        self::assertFalse($validator->check('rgb(1)'));
        self::assertFalse($validator->check('hsl(2)'));
        self::assertFalse($validator->check('rgba(1)'));
        self::assertFalse($validator->check('rgba(1)'));
        self::assertFalse($validator->check('#1'));
        self::assertFalse($validator->check('#1234'));
    }

    // ----------------------------------------
    // Channel tests
    // ----------------------------------------

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::hexChannel
     */
    public function hex_channel_matches_hex_value()
    {
        $validator = new ColorValidator();
        self::assertTrue($validator->hexChannel('FF'));
        self::assertTrue(ColorValidator::hexChannel('11'));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidHexChannelException
     * @covers \Gubler\Color\ColorValidator::hexChannel
     */
    public function hex_channel_errors_invalid_hex_value()
    {
        $validator = new ColorValidator();
        $validator->hexChannel('moo');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::rgbChannel
     */
    public function rgb_channel_matches_rgb_value()
    {
        $validator = new ColorValidator();
        self::assertTrue($validator->rgbChannel(100));
        self::assertTrue(ColorValidator::rgbChannel(233));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidRgbChannelException
     * @covers \Gubler\Color\ColorValidator::rgbChannel
     */
    public function rgb_channel_errors_invalid_rgb_value()
    {
        $validator = new ColorValidator();
        $validator->rgbChannel(256);
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::alphaChannel
     */
    public function alpha_channel_matches_alpha_value()
    {
        $validator = new ColorValidator();
        self::assertTrue($validator->alphaChannel(1));
        self::assertTrue($validator->alphaChannel(0));
        self::assertTrue(ColorValidator::alphaChannel(0.5));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidAlphaChannelException
     * @covers \Gubler\Color\ColorValidator::alphaChannel
     */
    public function alpha_channel_errors_invalid_alpha_value()
    {
        $validator = new ColorValidator();
        $validator->alphaChannel(1.1);
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::percentChannel
     */
    public function percent_channel_matches_percent_value()
    {
        $validator = new ColorValidator();
        self::assertTrue($validator->percentChannel('100%'));
        self::assertTrue($validator->percentChannel('0%'));
        self::assertTrue(ColorValidator::percentChannel('50%'));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidPercentChannelException
     * @covers \Gubler\Color\ColorValidator::percentChannel
     */
    public function percent_channel_errors_invalid_percent()
    {
        ColorValidator::percentChannel('a');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::hueChannel
     */
    public function hue_channel_matches_hue_value()
    {
        $validator = new ColorValidator();
        self::assertTrue($validator->hueChannel(135.33433));
        self::assertTrue($validator->hueChannel((float) -10));
        self::assertTrue(ColorValidator::hueChannel(10.5));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidHueChannelException
     * @covers \Gubler\Color\ColorValidator::hueChannel
     */
    public function hue_channel_errors_invalid_hue()
    {
        ColorValidator::hueChannel('m');
    }

    // ----------------------------------------
    // Color tests
    // ----------------------------------------

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::hex
     */
    public function hex_matches_hex_color()
    {
        $validator = new ColorValidator();
        self::assertTrue($validator->hex('#abcdef'));
        self::assertTrue(ColorValidator::hex('#123456'));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidHexColorException
     * @covers \Gubler\Color\ColorValidator::hex
     */
    public function hex_errors_invalid_hex_color()
    {
        $validator = new ColorValidator();
        $validator->hex('#FFF');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::shortHex
     */
    public function short_hex_matches_short_hex_color()
    {
        $validator = new ColorValidator();
        self::assertTrue($validator->shortHex('#fff'));
        self::assertTrue(ColorValidator::shortHex('#1A1'));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidHexColorException
     * @covers \Gubler\Color\ColorValidator::shortHex
     */
    public function short_hex_errors_invalid_short_hex_color()
    {
        $validator = new ColorValidator();
        $validator->shortHex('#FFFfff');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::rgb
     */
    public function rgb_matches_rgb_color()
    {
        $validator = new ColorValidator();
        self::assertTrue($validator->rgb('rgb(1,1,1)'));
        self::assertTrue(ColorValidator::rgb('rgb(0,255,0)'));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidRgbColorException
     * @covers \Gubler\Color\ColorValidator::rgb
     */
    public function rgb_errors_invalid_rgb_color()
    {
        $validator = new ColorValidator();
        $validator->rgb('rg(0,0,1000)');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::rgba
     */
    public function rgba_matches_rgba_color()
    {
        $validator = new ColorValidator();
        self::assertTrue($validator->rgba('rgba(1,1,1,0.2)'));
        self::assertTrue(ColorValidator::rgba('rgba(0,255,0,1)'));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidRgbaColorException
     * @covers \Gubler\Color\ColorValidator::rgba
     */
    public function rgba_errors_invalid_rgba_color()
    {
        $validator = new ColorValidator();
        $validator->rgba('rgb(0,0,100,3)');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::rgbPercent
     */
    public function rgb_percent_matches_rgb_percent_color()
    {
        $validator = new ColorValidator();
        self::assertTrue($validator->rgbPercent('rgb(1%,1%,1%)'));
        self::assertTrue(ColorValidator::rgbPercent('rgb(0%,100%,0%)'));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidRgbColorException
     * @covers \Gubler\Color\ColorValidator::rgbPercent
     */
    public function rgb_percent_errors_invalid_rgb_percent_color()
    {
        $validator = new ColorValidator();
        $validator->rgbPercent('rg(0,0,1000)');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::rgbaPercent
     */
    public function rgba_percent_matches_rgba_percent_color()
    {
        $validator = new ColorValidator();
        self::assertTrue($validator->rgbaPercent('rgba(1%,1%,1%,0.2)'));
        self::assertTrue(ColorValidator::rgbaPercent('rgba(0%,100%,0%,1)'));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidRgbaColorException
     * @covers \Gubler\Color\ColorValidator::rgbaPercent
     */
    public function rgba_percent_errors_invalid_rgba_percent_color()
    {
        $validator = new ColorValidator();
        $validator->rgbaPercent('rg(0,0,100,3)');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::hsl
     */
    public function hsl_matches_hsl_color()
    {
        $validator = new ColorValidator();
        self::assertTrue($validator->hsl('hsl(1.5,1%,1%)'));
        self::assertTrue(ColorValidator::hsl('hsl(100.344,50%,5%)'));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidHslColorException
     * @covers \Gubler\Color\ColorValidator::hsl
     */
    public function hsl_errors_invalid_hsl_color()
    {
        $validator = new ColorValidator();
        $validator->hsl('moo');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::hsla
     */
    public function hsla_matches_hsla_color()
    {
        $validator = new ColorValidator();
        self::assertTrue($validator->hsla('hsla(123.32,1%,100%,0.2)'));
        self::assertTrue(ColorValidator::hsla('hsla(0,55%,0%,1)'));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidHslaColorException
     * @covers \Gubler\Color\ColorValidator::hsla
     */
    public function hsla_errors_invalid_hsla_color()
    {
        $validator = new ColorValidator();
        $validator->hsla('moo');
    }
}
