<?php

namespace Gubler\Color\Test;

use Gubler\Color\ColorValidator;
use PHPUnit\Framework\TestCase;

class ColorValidatorTest extends TestCase
{
    protected ColorValidator $validator;

    public function setUp(): void
    {
        $this->validator = new ColorValidator();
    }

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
     * @covers \Gubler\Color\ColorValidator::isHexChannel
     */
    public function hex_channel_matches_hex_value(): void
    {
        self::assertTrue($this->validator->isHexChannel('FF'));
        self::assertFalse($this->validator->isHexChannel('moo'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::isRGBChannel
     */
    public function rgb_channel_matches_rgb_value(): void
    {
        self::assertTrue($this->validator->isRGBChannel(100));
        self::assertFalse($this->validator->isRGBChannel(256));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::isAlphaChannel
     */
    public function alpha_channel_matches_alpha_value(): void
    {
        self::assertTrue($this->validator->isAlphaChannel(1));
        self::assertTrue($this->validator->isAlphaChannel(0));
        self::assertTrue($this->validator->isAlphaChannel(0.3));
        self::assertFalse($this->validator->isAlphaChannel(1.1));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::isPercentChannel
     */
    public function percent_channel_matches_percent_value(): void
    {
        self::assertTrue($this->validator->isPercentChannel('100%'));
        self::assertTrue($this->validator->isPercentChannel('0%'));
        self::assertFalse($this->validator->isPercentChannel('10'));
        self::assertFalse($this->validator->isPercentChannel('a'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::isHexColorString
     */
    public function hex_matches_hex_color(): void
    {
        self::assertTrue($this->validator->isHexColorString('#abcdef'));
        self::assertTrue($this->validator->isHexColorString('#123456'));
        self::assertFalse($this->validator->isHexColorString('#FFF'));
        self::assertFalse($this->validator->isHexColorString('hello'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::isShortHex
     */
    public function short_hex_matches_short_hex_color(): void
    {
        self::assertTrue($this->validator->isShortHex('#fff'));
        self::assertTrue($this->validator->isShortHex('#1A1'));
        self::assertFalse($this->validator->isShortHex('#fffFFF'));
        self::assertFalse($this->validator->isShortHex('hello'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::isRGB
     */
    public function rgb_matches_rgb_color(): void
    {
        self::assertTrue($this->validator->isRGB('rgb(1,1,1)'));
        self::assertTrue($this->validator->isRGB('rgb(0,255,0)'));
        self::assertFalse($this->validator->isRGB('rgb(0,255,1000)'));
        self::assertFalse($this->validator->isRGB('hello'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::isRGBA
     */
    public function rgba_matches_rgba_color(): void
    {
        self::assertTrue($this->validator->isRGBA('rgba(1,1,1,0.2)'));
        self::assertTrue($this->validator->isRGBA('rgba(0,255,0,1)'));
        self::assertFalse($this->validator->isRGBA('rgba(0,255,0,3)'));
        self::assertFalse($this->validator->isRGBA('rgba(0,255,1000,1)'));
        self::assertFalse($this->validator->isRGBA('rgba(0,255,0,1.3)'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::isRGBPercent
     */
    public function rgb_percent_matches_rgb_percent_color(): void
    {
        self::assertTrue($this->validator->isRGBPercent('rgb(1%,1%,1%)'));
        self::assertTrue($this->validator->isRGBPercent('rgb(0%,100%,0%)'));
        self::assertFalse($this->validator->isRGBPercent('rgb(0,100,0)'));
        self::assertFalse($this->validator->isRGBPercent('rgb(0%,101%,0%)'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::isRGBAPercent
     */
    public function rgba_percent_matches_rgba_percent_color(): void
    {
        self::assertTrue($this->validator->isRGBAPercent('rgba(1%,1%,1%,0.2)'));
        self::assertTrue($this->validator->isRGBAPercent('rgba(0%,100%,0%,1)'));
        self::assertFalse($this->validator->isRGBAPercent('rgba(0%,100%,0%,1.1)'));
        self::assertFalse($this->validator->isRGBAPercent('rgba(0,100,0,1)'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::isHSL
     */
    public function hsl_matches_hsl_color(): void
    {
        self::assertTrue($this->validator->isHSL('hsl(1.5,1%,1%)'));
        self::assertTrue($this->validator->isHSL('hsl(100.344,50%,5%)'));
        self::assertFalse($this->validator->isHSL('hello'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorValidator::isHSLA
     */
    public function hsla_matches_hsla_color(): void
    {
        self::assertTrue($this->validator->isHSLA('hsla(123.32,1%,100%,0.2)'));
        self::assertTrue($this->validator->isHSLA('hsla(0,55%,0%,1)'));
        self::assertFalse($this->validator->isHSLA('hsla(0,55%,0%,1.1)'));
        self::assertFalse($this->validator->isHSLA('hello'));
    }
}
