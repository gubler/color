<?php

namespace Gubler\Color;

use Gubler\Color\Exception\InvalidColorException;

/**
 * Parse CSS color strings
 *
 * @package Gubler\Color
 */
class ColorParser
{
    const SHORT_HEX_REGEX = '/^#?([0-9a-f])([0-9a-f])([0-9a-f])$/i';
    const LONG_HEX_REGEX = '/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i';
    const RGB_REGEX = '/^rgb\(\s*(\d*)\s*,\s*(\d*)\s*,\s*(\d*)\s*\)$/';
    const RGBA_REGEX = '/^rgba\(\s*(\d*)\s*,\s*(\d*)\s*,\s*(\d*)\s*,\s*(.*)\s*\)$/';
    const RGB_PERCENT_REGEX = '/^rgb\(\s*(\d*%)\s*,\s*(\d*%)\s*,\s*(\d*%)\s*\)$/';
    const RGBA_PERCENT_REGEX = '/^rgba\(\s*(\d*%)\s*,\s*(\d*%)\s*,\s*(\d*%)\s*,\s*(.*)\s*\)$/';
    const HSL_REGEX = '/^hsl\(\s*(.*)\s*,\s*(.*%)\s*,\s*(.*%)\s*\)$/';
    const HSLA_REGEX = '/^hsla\(\s*(.*)\s*,\s*(.*%)\s*,\s*(.*%)\s*,\s*(.*)\s*\)$/';

    /** @var int */
    protected $red;
    /** @var int */
    protected $green;
    /** @var int */
    protected $blue;
    /** @var float */
    protected $alpha;
    /** @var ColorValidator */
    protected $validator;
    /** @var ColorConverter */
    protected $converter;

    /**
     * ColorParser constructor.
     *
     * @param string|null $color
     */
    public function __construct(string $color = null)
    {
        $this->validator = new ColorValidator();
        $this->converter = new ColorConverter();

        if ($color !== null) {
            $this->parseColor($color);
        }
    }

    /**
     * Return an array of RGBA values
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'red' => $this->red,
            'green' => $this->green,
            'blue' => $this->blue,
            'alpha' => $this->alpha
        ];
    }

    /**
     * Parse a CSS color string and return an RGBA array
     *
     * @param string $color
     *
     * @return ColorParser
     */
    public function parse(string $color)
    {
        $this->parseColor($color);
        return $this;
    }

    /**
     * Parse a CSS color string for type.
     *
     * This also checks that the color values are valid for the type.
     *
     * Valid return types are
     *     - rgb
     *     - rgba
     *     - hsl
     *     - hsla
     *     - hex
     *     - shortHex
     *
     * @param string $color
     *
     * @return string
     * @throws InvalidColorException if string does not match a recognized color type
     */
    public function colorType(string $color)
    {
        if (preg_match(self::RGB_REGEX, $color)) {
            $this->validator->rgb($color);
            return 'rgb';
        } elseif (preg_match(self::RGBA_REGEX, $color)) {
            $this->validator->rgba($color);
            return 'rgba';
        } elseif (preg_match(self::RGB_PERCENT_REGEX, $color)) {
            $this->validator->rgbPercent($color);
            return 'rgbPercent';
        } elseif (preg_match(self::RGBA_PERCENT_REGEX, $color)) {
            $this->validator->rgbaPercent($color);
            return 'rgbaPercent';
        } elseif (preg_match(self::HSL_REGEX, $color)) {
            $this->validator->hsl($color);
            return 'hsl';
        } elseif (preg_match(self::HSLA_REGEX, $color)) {
            $this->validator->hsla($color);
            return 'hsla';
        } elseif (preg_match(self::LONG_HEX_REGEX, $color)) {
            $this->validator->hex($color);
            return 'hex';
        } elseif (preg_match(self::SHORT_HEX_REGEX, $color)) {
            $this->validator->shortHex($color);
            return 'shortHex';
        }

        throw new InvalidColorException('Unrecognized color. `'.$color.'` provided.');
    }

    /**
     * @param string $color
     */
    protected function parseColor(string $color)
    {
        switch ($this->colorType($color)) {
            case 'rgb':
                $this->parseRgb($color);
                break;
            case 'rgba':
                $this->parseRgba($color);
                break;
            case 'rgbPercent':
                $this->parseRgbPercent($color);
                break;
            case 'rgbaPercent':
                $this->parseRgbaPercent($color);
                break;
            case 'hex':
                $this->parseHex($color);
                break;
            case 'shortHex':
                $this->parseShortHex($color);
                break;
            case 'hsl':
                $this->parseHsl($color);
                break;
            case 'hsla':
                $this->parseHsla($color);
                break;
        }
    }

    /**
     * @param string $color
     */
    protected function parseRgb(string $color)
    {
        $this->validator->rgb($color);
        $matches = [];
        preg_match(self::RGB_REGEX, $color, $matches);

        $this->red = (int) $matches[1];
        $this->green = (int) $matches[2];
        $this->blue = (int) $matches[3];
        $this->alpha = 1.0;
    }

    /**
     * @param string $color
     */
    protected function parseRgba(string $color)
    {
        $this->validator->rgba($color);
        $matches = [];
        preg_match(self::RGBA_REGEX, $color, $matches);

        $this->red = (int) $matches[1];
        $this->green = (int) $matches[2];
        $this->blue = (int) $matches[3];
        $this->alpha = (float) $matches[4];
    }

    /**
     * @param string $color
     */
    protected function parseRgbPercent(string $color)
    {
        $this->validator->rgbPercent($color);
        $matches = [];
        preg_match(self::RGB_PERCENT_REGEX, $color, $matches);

        $this->red = $this->rgbValue($matches[1]);
        $this->green = $this->rgbValue($matches[2]);
        $this->blue = $this->rgbValue($matches[3]);
        $this->alpha = 1.0;
    }

    /**
     * @param string $color
     */
    protected function parseRgbaPercent(string $color)
    {
        $this->validator->rgbaPercent($color);
        $matches = [];
        preg_match(self::RGBA_PERCENT_REGEX, $color, $matches);

        $this->red = $this->rgbValue($matches[1]);
        $this->green = $this->rgbValue($matches[2]);
        $this->blue = $this->rgbValue($matches[3]);
        $this->alpha = (float) $matches[4];
    }

    /**
     * @param string $color
     */
    protected function parseHsl(string $color)
    {
        $this->validator->hsl($color);
        $matches = [];
        preg_match(self::HSL_REGEX, $color, $matches);

        $rgb = $this->converter->hslToRgb(
            (float) $matches[1],
            (int) $matches[2],
            (int) $matches[3]
        );

        $this->red = $rgb['red'];
        $this->green = $rgb['green'];
        $this->blue = $rgb['blue'];
        $this->alpha = 1.0;
    }

    /**
     * @param string $color
     */
    protected function parseHsla(string $color)
    {
        $this->validator->hsla($color);
        $matches = [];
        preg_match(self::HSLA_REGEX, $color, $matches);

        $rgb = $this->converter->hslToRgb(
            (float) $matches[1],
            (int) $matches[2],
            (int) $matches[3]
        );

        $this->red = $rgb['red'];
        $this->green = $rgb['green'];
        $this->blue = $rgb['blue'];
        $this->alpha = (float) $matches[4];
    }

    /**
     * @param string $color
     */
    protected function parseHex(string $color)
    {
        $this->validator->hex($color);
        $rgb = $this->converter->hexToRgb($color);

        $this->red = $rgb['red'];
        $this->green = $rgb['green'];
        $this->blue = $rgb['blue'];
        $this->alpha = 1.0;
    }

    /**
     * @param string $color
     */
    protected function parseShortHex(string $color)
    {
        $this->validator->shortHex($color);
        $rgb = $this->converter->shortHexToRgb($color);

        $this->red = $rgb['red'];
        $this->green = $rgb['green'];
        $this->blue = $rgb['blue'];
        $this->alpha = 1.0;
    }

    /**
     * Convert a 0%-100% value to 0-255 value for RGB.
     *
     * @param string $value
     *
     * @return int
     */
    protected function rgbValue(string $value): int
    {
        $percent = (int) $value;

        return (int) round($percent * 2.55);
    }
}
