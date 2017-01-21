<?php

namespace Gubler\Color\Test;

use Gubler\Color\ColorValidator;

/**
 * Class ColorValidatorTest.
 */
class ColorValidatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var ColorValidator */
    protected $validator;

    /**
     * Set Up.
     */
    public function setUp()
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
    public function check_matches_valid_colors()
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
    public function check_errors_invalid_colors()
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
    public function hex_channel_matches_hex_value()
    {
        self::assertTrue($this->validator->hexChannel('FF'));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidHexChannelException
     * @covers \Gubler\Color\ColorValidator::hexChannel
     */
    public function hex_channel_errors_invalid_hex_value()
    {
        $this->validator->hexChannel('moo');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::rgbChannel
     */
    public function rgb_channel_matches_rgb_value()
    {
        self::assertTrue($this->validator->rgbChannel(100));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidRgbChannelException
     * @covers \Gubler\Color\ColorValidator::rgbChannel
     */
    public function rgb_channel_errors_invalid_rgb_value()
    {
        $this->validator->rgbChannel(256);
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::alphaChannel
     */
    public function alpha_channel_matches_alpha_value()
    {
        self::assertTrue($this->validator->alphaChannel(1));
        self::assertTrue($this->validator->alphaChannel(0));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidAlphaChannelException
     * @covers \Gubler\Color\ColorValidator::alphaChannel
     */
    public function alpha_channel_errors_invalid_alpha_value()
    {
        $this->validator->alphaChannel(1.1);
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::percentChannel
     */
    public function percent_channel_matches_percent_value()
    {
        self::assertTrue($this->validator->percentChannel('100%'));
        self::assertTrue($this->validator->percentChannel('0%'));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidPercentChannelException
     * @covers \Gubler\Color\ColorValidator::percentChannel
     */
    public function percent_channel_errors_invalid_percent()
    {
        $this->validator->percentChannel('a');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::hueChannel
     */
    public function hue_channel_matches_hue_value()
    {
        self::assertTrue($this->validator->hueChannel(135.33433));
        self::assertTrue($this->validator->hueChannel((float) -10));
        self::assertTrue($this->validator->hueChannel(10.5));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidHueChannelException
     * @covers \Gubler\Color\ColorValidator::hueChannel
     */
    public function hue_channel_errors_invalid_hue()
    {
        $this->validator->hueChannel('m');
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
        self::assertTrue($this->validator->hex('#abcdef'));
        self::assertTrue($this->validator->hex('#123456'));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidHexColorException
     * @covers \Gubler\Color\ColorValidator::hex
     */
    public function hex_errors_invalid_hex_color()
    {
        $this->validator->hex('#FFF');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::shortHex
     */
    public function short_hex_matches_short_hex_color()
    {
        self::assertTrue($this->validator->shortHex('#fff'));
        self::assertTrue($this->validator->shortHex('#1A1'));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidHexColorException
     * @covers \Gubler\Color\ColorValidator::shortHex
     */
    public function short_hex_errors_invalid_short_hex_color()
    {
        $this->validator->shortHex('#FFFfff');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::rgb
     */
    public function rgb_matches_rgb_color()
    {
        self::assertTrue($this->validator->rgb('rgb(1,1,1)'));
        self::assertTrue($this->validator->rgb('rgb(0,255,0)'));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidRgbColorException
     * @covers \Gubler\Color\ColorValidator::rgb
     */
    public function rgb_errors_invalid_rgb_color()
    {
        $this->validator->rgb('rg(0,0,1000)');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::rgba
     */
    public function rgba_matches_rgba_color()
    {
        self::assertTrue($this->validator->rgba('rgba(1,1,1,0.2)'));
        self::assertTrue($this->validator->rgba('rgba(0,255,0,1)'));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidRgbaColorException
     * @covers \Gubler\Color\ColorValidator::rgba
     */
    public function rgba_errors_invalid_rgba_color()
    {
        $this->validator->rgba('rgb(0,0,100,3)');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::rgbPercent
     */
    public function rgb_percent_matches_rgb_percent_color()
    {
        self::assertTrue($this->validator->rgbPercent('rgb(1%,1%,1%)'));
        self::assertTrue($this->validator->rgbPercent('rgb(0%,100%,0%)'));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidRgbColorException
     * @covers \Gubler\Color\ColorValidator::rgbPercent
     */
    public function rgb_percent_errors_invalid_rgb_percent_color()
    {
        $this->validator->rgbPercent('rg(0,0,1000)');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::rgbaPercent
     */
    public function rgba_percent_matches_rgba_percent_color()
    {
        self::assertTrue($this->validator->rgbaPercent('rgba(1%,1%,1%,0.2)'));
        self::assertTrue($this->validator->rgbaPercent('rgba(0%,100%,0%,1)'));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidRgbaColorException
     * @covers \Gubler\Color\ColorValidator::rgbaPercent
     */
    public function rgba_percent_errors_invalid_rgba_percent_color()
    {
        $this->validator->rgbaPercent('rg(0,0,100,3)');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::hsl
     */
    public function hsl_matches_hsl_color()
    {
        self::assertTrue($this->validator->hsl('hsl(1.5,1%,1%)'));
        self::assertTrue($this->validator->hsl('hsl(100.344,50%,5%)'));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidHslColorException
     * @covers \Gubler\Color\ColorValidator::hsl
     */
    public function hsl_errors_invalid_hsl_color()
    {
        $this->validator->hsl('moo');
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::hsla
     */
    public function hsla_matches_hsla_color()
    {
        self::assertTrue($this->validator->hsla('hsla(123.32,1%,100%,0.2)'));
        self::assertTrue($this->validator->hsla('hsla(0,55%,0%,1)'));
    }

    /**
     * @test
     * @expectedException \Gubler\Color\Exception\InvalidHslaColorException
     * @covers \Gubler\Color\ColorValidator::hsla
     */
    public function hsla_errors_invalid_hsla_color()
    {
        $this->validator->hsla('moo');
    }
}
