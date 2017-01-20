<?php

namespace Gubler\Color\Test;

use Gubler\Color\ColorConverter;

/**
 * Class ColorConverterTest
 *
 * @package Gubler\Color\Test
 */
class ColorConverterTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function can_instantiate_class()
    {
        $converter = new ColorConverter();
        self::assertInstanceOf(ColorConverter::class, $converter);
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorConverter
     */
    public function converts_short_hex_to_rgb()
    {
        $color = [
            'red' => 17,
            'green' => 34,
            'blue' => 51,
        ];

        $converter = new ColorConverter();
        self::assertEquals($color, $converter->shortHexToRgb('#123'));
        self::assertEquals($color, ColorConverter::shortHexToRgb('#123'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorConverter
     */
    public function converts_hex_to_rgb()
    {
        $color = [
            'red' => 171,
            'green' => 205,
            'blue' => 239,
        ];

        $converter = new ColorConverter();
        self::assertEquals($color, $converter->hexToRgb('#abcdef'));
        self::assertEquals($color, ColorConverter::hexToRgb('#ABCDEF'));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorConverter
     */
    public function converts_rgb_to_hex()
    {
        $color = '#ABCDEF';

        $converter = new ColorConverter();
        self::assertEquals($color, $converter->rgbToHex(171, 205, 239));
        self::assertEquals($color, ColorConverter::rgbToHex(171, 205, 239));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorConverter
     */
    public function converts_hsl_to_rgb()
    {
        $color = [
            'red' => 64,
            'green' => 191,
            'blue' => 70,
        ];

        $converter = new ColorConverter();
        self::assertEquals($color, $converter->hslToRgb(123, 50, 50));
        self::assertEquals($color, ColorConverter::hslToRgb(123, 50, 50));

        $color = [
            'red' => 51,
            'green' => 51,
            'blue' => 51,
        ];
        self::assertEquals($color, ColorConverter::hslToRgb(0, 0, 20));

        $color = [
            'red' => 80,
            'green' => 200,
            'blue' => 20,
        ];
        self::assertEquals($color, ColorConverter::hslToRgb(100, 82, 43));

        $color = [
            'red' => 20,
            'green' => 200,
            'blue' => 80,
        ];
        self::assertEquals($color, ColorConverter::hslToRgb(140, 82, 43));

        $color = [
            'red' => 20,
            'green' => 140,
            'blue' => 200,
        ];
        self::assertEquals($color, ColorConverter::hslToRgb(200, 82, 43));

        $color = [
            'red' => 170,
            'green' => 20,
            'blue' => 200,
        ];
        self::assertEquals($color, ColorConverter::hslToRgb(290, 82, 43));

        $color = [
            'red' => 200,
            'green' => 20,
            'blue' => 80,
        ];
        self::assertEquals($color, ColorConverter::hslToRgb(340, 82, 43));
    }

    /**
     * @test
     * @covers \Gubler\Color\ColorConverter
     */
    public function converts_rgb_to_hsl()
    {
        $color = [
            'hue' => 350,
            'saturation' => 100,
            'luminosity' => 50,
        ];

        $converter = new ColorConverter();
        self::assertEquals($color, $converter->rgbToHsl(255, 0, 43));
        self::assertEquals($color, ColorConverter::rgbToHsl(255, 0, 43));

        $color = [
            'hue' => 0,
            'saturation' => 0,
            'luminosity' => 20,
        ];
        self::assertEquals($color, ColorConverter::rgbToHsl(50, 50, 50));

        $color = [
            'hue' => 120,
            'saturation' => 82,
            'luminosity' => 43,
        ];
        self::assertEquals($color, ColorConverter::rgbToHsl(20, 200, 20));

        $color = [
            'hue' => 240,
            'saturation' => 82,
            'luminosity' => 43,
        ];
        self::assertEquals($color, ColorConverter::rgbToHsl(20, 20, 200));
    }
}
