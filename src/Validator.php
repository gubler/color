<?php

namespace Gubler\Color;

use Gubler\Color\Exception\InvalidAlphaChannelException;
use Gubler\Color\Exception\InvalidColorException;
use Gubler\Color\Exception\InvalidHexChannelException;
use Gubler\Color\Exception\InvalidHexColorException;
use Gubler\Color\Exception\InvalidRgbaColorException;
use Gubler\Color\Exception\InvalidRgbChannelException;
use Gubler\Color\Exception\InvalidRgbColorException;

/**
 * Class Validator
 *
 * @package Gubler\Color
 */
class Validator
{
    const RGB_CHANNEL_MIN = 0;
    const RGB_CHANNEL_MAX = 255;
    const ALPHA_CHANNEL_MIN = 0;
    const ALPHA_CHANNEL_MAX = 1;
    const HEX_CHANNEL_REGEX = '/^[0-9a-f]{2}$/i';
    const SHORT_HEX_REGEX = '/^#?[0-9a-f]{3}$/i';
    const LONG_HEX_REGEX = '/^#?[0-9a-f]{6}$/i';
    const RGB_REGEX = '/^rgb\(\s*\d{1,3},\s*\d{1,3},\s*\d{1,3}\)$/';
    const RGBA_REGEX = '/^rgba\(\s*\d{1,3},\s*\d{1,3},\s*\d{1,3},\s*(0|1|0\.[1-9]+)\s*\)$/';

    public static function check(string $color)
    {
        if (substr($color, 0, 5) === 'rgba(') {
            return self::rgba($color);
        } elseif (substr($color, 0, 4) === 'rgb(') {
            return self::rgb($color);
        } elseif (substr($color, 0, 1) === '#' || strlen($color) === 6) {
            return self::hex($color);
        }

        throw new InvalidColorException('Invalid Color. `'.$color.'` provided.');
    }

    public static function hexChannel(string $hex)
    {
        if (preg_match(self::HEX_CHANNEL_REGEX, $hex) === 0) {
            throw new InvalidHexChannelException($hex);
        }

        return true;
    }

    public static function rgbChannel(int $rgb)
    {
        if ($rgb < self::RGB_CHANNEL_MIN || $rgb > self::RGB_CHANNEL_MAX) {
            throw new InvalidRgbChannelException($rgb);
        }

        return true;
    }

    public static function alphaChannel(float $alpha)
    {
        if ($alpha < self::ALPHA_CHANNEL_MIN || $alpha > self::ALPHA_CHANNEL_MAX) {
            throw new InvalidAlphaChannelException($alpha);
        }

        return true;
    }

    public static function hex(string $hex)
    {
        if (preg_match(self::LONG_HEX_REGEX, $hex) === 0) {
            throw new InvalidHexColorException($hex);
        }

        return true;
    }

    public static function shortHex(string $hex)
    {
        if (preg_match(self::SHORT_HEX_REGEX, $hex) === 0) {
            throw new InvalidHexColorException($hex);
        }

        return true;
    }

    public static function rgb(string $rgb)
    {
        if (preg_match(self::RGB_REGEX, $rgb) === 0) {
            throw new InvalidRgbColorException($rgb);
        }

        return true;
    }

    public static function rgba(string $rgba)
    {
        if (preg_match(self::RGBA_REGEX, $rgba) === 0) {
            throw new InvalidRgbaColorException($rgba);
        }

        return true;
    }
}
