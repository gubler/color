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
    /** @test */
    public function check_matches_valid_colors()
    {
        $validator = new ColorValidator();

        self::assertTrue($validator->check('rgb(1,1,1)'));
        self::assertTrue($validator->check('rgba(1,1,1,1)'));
        self::assertTrue($validator->check('#111111'));
        self::assertTrue($validator->check('#111'));

        self::assertTrue(ColorValidator::check('rgb(1,1,1)'));
        self::assertTrue(ColorValidator::check('rgba(1,1,1,1)'));
        self::assertTrue(ColorValidator::check('#111111'));
        self::assertTrue(ColorValidator::check('#111'));
    }

    /**
     * @test
     * @expectedException Gubler\Color\Exception\InvalidColorException
     */
    public function check_errors_invalid_colors()
    {
        $validator = new ColorValidator();
        $validator->check('moo');
    }

    /** @test */
    public function hex_channel_matches_hex_value()
    {
        $validator = new ColorValidator();
        self::assertTrue($validator->hexChannel('FF'));
        self::assertTrue(ColorValidator::hexChannel('11'));
    }

    /**
     * @test
     * @expectedException Gubler\Color\Exception\InvalidHexChannelException
     */
    public function hex_channel_errors_invalid_hex_value()
    {
        $validator = new ColorValidator();
        $validator->hexChannel('moo');
    }

    /** @test */
    public function rgb_channel_matches_rgb_value()
    {
        $validator = new ColorValidator();
        self::assertTrue($validator->rgbChannel(100));
        self::assertTrue(ColorValidator::rgbChannel(233));
    }

    /**
     * @test
     * @expectedException Gubler\Color\Exception\InvalidRgbChannelException
     */
    public function rgb_channel_errors_invalid_rgb_value()
    {
        $validator = new ColorValidator();
        $validator->rgbChannel(256);
    }

    /** @test */
    public function alpha_channel_matches_alpha_value()
    {
        $validator = new ColorValidator();
        self::assertTrue($validator->alphaChannel(1));
        self::assertTrue($validator->alphaChannel(0));
        self::assertTrue(ColorValidator::alphaChannel(0.5));
    }

    /**
     * @test
     * @expectedException Gubler\Color\Exception\InvalidAlphaChannelException
     */
    public function alpha_channel_errors_invalid_alpha_value()
    {
        $validator = new ColorValidator();
        $validator->alphaChannel(1.1);
    }

    /** @test */
    public function hex_matches_hex_color()
    {
        $validator = new ColorValidator();
        self::assertTrue($validator->hex('#ffffff'));
        self::assertTrue(ColorValidator::hex('#1A1E00'));
    }

    /**
     * @test
     * @expectedException Gubler\Color\Exception\InvalidHexColorException
     */
    public function hex_errors_invalid_hex_color()
    {
        $validator = new ColorValidator();
        $validator->hex('#FFF');
    }

    /** @test */
    public function short_hex_matches_short_hex_color()
    {
        $validator = new ColorValidator();
        self::assertTrue($validator->shortHex('#fff'));
        self::assertTrue(ColorValidator::shortHex('#1A1'));
    }

    /**
     * @test
     * @expectedException Gubler\Color\Exception\InvalidHexColorException
     */
    public function short_hex_errors_invalid_short_hex_color()
    {
        $validator = new ColorValidator();
        $validator->shortHex('#FFFfff');
    }

    /** @test */
    public function rgb_matches_rgb_color()
    {
        $validator = new ColorValidator();
        self::assertTrue($validator->rgb('rgb(1,1,1)'));
        self::assertTrue(ColorValidator::rgb('rgb(0,255,0)'));
    }

    /**
     * @test
     * @expectedException Gubler\Color\Exception\InvalidRgbColorException
     */
    public function rgb_errors_invalid_rgb_color()
    {
        $validator = new ColorValidator();
        $validator->rgb('rgb(0,0,1000)');
    }

    /** @test */
    public function rgba_matches_rgba_color()
    {
        $validator = new ColorValidator();
        self::assertTrue($validator->rgba('rgba(1,1,1,0.2)'));
        self::assertTrue(ColorValidator::rgba('rgba(0,255,0,1)'));
    }

    /**
     * @test
     * @expectedException Gubler\Color\Exception\InvalidRgbaColorException
     */
    public function rgba_errors_invalid_rgba_color()
    {
        $validator = new ColorValidator();
        $validator->rgba('rgba(0,0,100,3)');
    }
}
