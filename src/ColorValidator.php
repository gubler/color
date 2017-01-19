<?php

namespace Gubler\Color;

use Gubler\Color\Exception\InvalidAlphaChannelException;
use Gubler\Color\Exception\InvalidColorException;
use Gubler\Color\Exception\InvalidHexChannelException;
use Gubler\Color\Exception\InvalidHexColorException;
use Gubler\Color\Exception\InvalidHslaColorException;
use Gubler\Color\Exception\InvalidHslColorException;
use Gubler\Color\Exception\InvalidHueChannelException;
use Gubler\Color\Exception\InvalidPercentChannelException;
use Gubler\Color\Exception\InvalidRgbaColorException;
use Gubler\Color\Exception\InvalidRgbChannelException;
use Gubler\Color\Exception\InvalidRgbColorException;

/**
 * Class ColorValidator
 *
 * @package Gubler\Color
 */
class ColorValidator
{
    const RGB_CHANNEL_MIN = 0;
    const RGB_CHANNEL_MAX = 255;
    const ALPHA_CHANNEL_MIN = 0;
    const ALPHA_CHANNEL_MAX = 1;
    const HEX_CHANNEL_REGEX = '/^[0-9a-f]{2}$/i';
    const SHORT_HEX_REGEX = '/^#?([0-9a-f])([0-9a-f])([0-9a-f])$/i';
    const LONG_HEX_REGEX = '/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i';
    const RGB_REGEX = '/^rgb\(\s*(\d*)\s*,\s*(\d*)\s*,\s*(\d*)\s*\)$/';
    const RGBA_REGEX = '/^rgba\(\s*(\d*)\s*,\s*(\d*)\s*,\s*(\d*)\s*,\s*(.*)\s*\)$/';
    const RGB_PERCENT_REGEX = '/^rgb\(\s*(\d*%)\s*,\s*(\d*%)\s*,\s*(\d*%)\s*\)$/';
    const RGBA_PERCENT_REGEX = '/^rgba\(\s*(\d*%)\s*,\s*(\d*%)\s*,\s*(\d*%)\s*,\s*(.*)\s*\)$/';
    const HSL_REGEX = '/^hsl\(\s*(.*)\s*,\s*(.*%)\s*,\s*(.*%)\s*\)$/';
    const HSLA_REGEX = '/^hsla\(\s*(.*)\s*,\s*(.*%)\s*,\s*(.*%)\s*,\s*(.*)\s*\)$/';

    /**
     * Checks if a string is a valid color
     *
     * @param string $color
     *
     * @return bool
     * @throws InvalidColorException
     */
    public static function check(string $color): bool
    {
        // parse determines the color type and checks the validity of the color
        // values (using other methods in this class) or throws an InvalidColorException.
        // So we might was well just use that. If the parsing doesn't throw an error, then
        // the color is valid. Otherwise, trap the exception and return false.

        try {
            ColorParser::parse($color);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * Validate that a hex channel falls within 00-FF (case insensitive)
     *
     * @param string $hex
     *
     * @return bool
     * @throws InvalidHexChannelException
     */
    public static function hexChannel(string $hex)
    {
        if (preg_match(self::HEX_CHANNEL_REGEX, $hex) === 0) {
            throw new InvalidHexChannelException($hex);
        }

        return true;
    }

    /**
     * @param mixed $rgb
     *
     * @return bool
     * @throws InvalidRgbChannelException
     */
    public static function rgbChannel(int $rgb)
    {
        // check for 0-255 values
        if ($rgb >= self::RGB_CHANNEL_MIN && $rgb <= self::RGB_CHANNEL_MAX) {
            return true;
        }

        throw new InvalidRgbChannelException($rgb);
    }

    /**
     * @param mixed $rgb
     *
     * @return bool
     * @throws InvalidPercentChannelException
     */
    public static function percentChannel($rgb)
    {
        // check for 0%-100%
        if (substr($rgb, -1, 1) === '%') {
            $percent = (int) $rgb;

            if ($percent >= 0 && $percent <= 100) {
                return true;
            }
        }

        throw new InvalidPercentChannelException($rgb);
    }

    /**
     * @param float $alpha
     *
     * @return bool
     * @throws InvalidAlphaChannelException
     */
    public static function alphaChannel(float $alpha)
    {
        if ($alpha < self::ALPHA_CHANNEL_MIN || $alpha > self::ALPHA_CHANNEL_MAX) {
            throw new InvalidAlphaChannelException($alpha);
        }

        return true;
    }

    /**
     * @param float $hue
     *
     * @return bool
     * @throws InvalidHueChannelException
     */
    public static function hueChannel($hue)
    {
        if (is_float($hue)) {
            return true;
        }

        throw new InvalidHueChannelException($hue);
    }

    /**
     * Validate hex color string
     *
     * @param string $hex
     *
     * @return bool
     * @throws InvalidHexColorException
     */
    public static function hex(string $hex)
    {
        $matches = [];
        preg_match(self::LONG_HEX_REGEX, $hex, $matches);
        if (count($matches) !== 4) {
            throw new InvalidHexColorException($hex);
        }

        self::hexChannel($matches[1]);
        self::hexChannel($matches[2]);
        self::hexChannel($matches[3]);

        return true;
    }

    /**
     * Validate short hex color string
     *
     * @param string $hex
     *
     * @return bool
     * @throws InvalidHexColorException
     */
    public static function shortHex(string $hex)
    {
        $matches = [];
        preg_match(self::SHORT_HEX_REGEX, $hex, $matches);

        if (count($matches) !== 4) {
            throw new InvalidHexColorException($hex);
        }

        self::hexChannel($matches[1].$matches[1]);
        self::hexChannel($matches[2].$matches[2]);
        self::hexChannel($matches[3].$matches[3]);

        return true;
    }

    /**
     * Validate RGB string
     *
     * @param string $rgb
     *
     * @return bool
     * @throws InvalidRgbColorException
     */
    public static function rgb(string $rgb)
    {
        $matches = [];
        preg_match(self::RGB_REGEX, $rgb, $matches);

        if (count($matches) !== 4) {
            throw new InvalidRgbColorException($rgb);
        }

        self::rgbChannel((int) $matches[1]);
        self::rgbChannel((int) $matches[2]);
        self::rgbChannel((int) $matches[3]);

        return true;
    }

    /**
     * Validate RGBA string
     *
     * @param string $rgba
     *
     * @return bool
     * @throws InvalidRgbaColorException
     */
    public static function rgba(string $rgba)
    {
        $matches = [];
        preg_match(self::RGBA_REGEX, $rgba, $matches);

        if (count($matches) !== 5) {
            throw new InvalidRgbaColorException($rgba);
        }

        self::rgbChannel((int) $matches[1]);
        self::rgbChannel((int) $matches[2]);
        self::rgbChannel((int) $matches[3]);
        self::alphaChannel($matches[4]);

        return true;
    }

    /**
     * Validate RGB string
     *
     * @param string $rgb
     *
     * @return bool
     * @throws InvalidRgbColorException
     */
    public static function rgbPercent(string $rgb)
    {
        $matches = [];
        preg_match(self::RGB_PERCENT_REGEX, $rgb, $matches);

        if (count($matches) !== 4) {
            throw new InvalidRgbColorException($rgb);
        }

        self::percentChannel($matches[1]);
        self::percentChannel($matches[2]);
        self::percentChannel($matches[3]);

        return true;
    }

    /**
     * Validate RGBA string
     *
     * @param string $rgba
     *
     * @return bool
     * @throws InvalidRgbaColorException
     */
    public static function rgbaPercent(string $rgba)
    {
        $matches = [];
        preg_match(self::RGBA_PERCENT_REGEX, $rgba, $matches);

        if (count($matches) !== 5) {
            throw new InvalidRgbaColorException($rgba);
        }

        self::percentChannel($matches[1]);
        self::percentChannel($matches[2]);
        self::percentChannel($matches[3]);
        self::alphaChannel((float) $matches[4]);

        return true;
    }

    /**
     * Validate HSL string
     *
     * @param string $hsl
     *
     * @return bool
     * @throws InvalidHslColorException
     */
    public static function hsl(string $hsl)
    {
        $matches = [];
        preg_match(self::HSL_REGEX, $hsl, $matches);

        if (count($matches) !== 4) {
            throw new InvalidHslColorException($hsl);
        }

        self::hueChannel((float) $matches[1]);
        self::percentChannel($matches[2]);
        self::percentChannel($matches[3]);

        return true;
    }

    /**
     * Validate HSLA string
     *
     * @param string $hsla
     *
     * @return bool
     * @throws InvalidHslaColorException
     */
    public static function hsla(string $hsla)
    {
        $matches = [];
        preg_match(self::HSLA_REGEX, $hsla, $matches);

        if (count($matches) !== 5) {
            throw new InvalidHslaColorException($hsla);
        }

        self::hueChannel((float) $matches[1]);
        self::percentChannel($matches[2]);
        self::percentChannel($matches[3]);
        self::alphaChannel((float) $matches[4]);

        return true;
    }
}
