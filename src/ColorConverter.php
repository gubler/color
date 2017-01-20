<?php

namespace Gubler\Color;

/**
 * Class Converter
 *
 * @package Gubler\Color
 */
class ColorConverter
{
    const SHORT_HEX_REGEX = '/^#?([0-9a-f])([0-9a-f])([0-9a-f])$/i';
    const LONG_HEX_REGEX = '/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i';

    /**
     * @param string $hexValue
     *
     * @return array
     */
    public static function hexToRgb(string $hexValue): array
    {
        ColorValidator::hex($hexValue);

        $matches = [];
        preg_match(self::LONG_HEX_REGEX, $hexValue, $matches);

        return [
            'red' => self::hexChannelToRgbChannel($matches[1]),
            'green' => self::hexChannelToRgbChannel($matches[2]),
            'blue' => self::hexChannelToRgbChannel($matches[3]),
        ];
    }

    /**
     * @param string $hexValue
     *
     * @return array
     */
    public static function shortHexToRgb(string $hexValue): array
    {
        ColorValidator::shortHex($hexValue);

        $matches = [];
        preg_match(self::SHORT_HEX_REGEX, $hexValue, $matches);

        return [
            'red' => self::hexChannelToRgbChannel($matches[1].$matches[1]),
            'green' => self::hexChannelToRgbChannel($matches[2].$matches[2]),
            'blue' => self::hexChannelToRgbChannel($matches[3].$matches[3]),
        ];
    }

    /**
     * @param int $red
     * @param int $green
     * @param int $blue
     *
     * @return string
     */
    public static function rgbToHex(int $red, int $green, int $blue): string
    {
        $redHex = self::rgbChannelToHexChannel($red);
        $greenHex = self::rgbChannelToHexChannel($green);
        $blueHex = self::rgbChannelToHexChannel($blue);

        return strtoupper('#'.$redHex.$greenHex.$blueHex);
    }

    /**
     * Convert HSL values to RGB array
     *
     * @param float $hue
     * @param int   $saturation
     * @param int   $luminosity
     *
     * @return array
     */
    public static function hslToRgb(float $hue, int $saturation, int $luminosity)
    {
        $red = null;
        $green = null;
        $blue = null;

        $hue /= 60;
        if ($hue < 0) $hue = 6 - fmod(-$hue, 6);
        $hue = fmod($hue, 6);

        $saturation = max(0, min(1, $saturation / 100));
        $luminosity = max(0, min(1, $luminosity / 100));

        $chroma = (1 - abs((2 * $luminosity) - 1)) * $saturation;
        $intermediate = $chroma * (1 - abs(fmod($hue, 2) - 1));

        if ($hue < 1) {
            $red = $chroma;
            $green = $intermediate;
            $blue = 0;
        } elseif ($hue < 2) {
            $red = $intermediate;
            $green = $chroma;
            $blue = 0;
        } elseif ($hue < 3) {
            $red = 0;
            $green = $chroma;
            $blue = $intermediate;
        } elseif ($hue < 4) {
            $red = 0;
            $green = $intermediate;
            $blue = $chroma;
        } elseif ($hue < 5) {
            $red = $intermediate;
            $green = 0;
            $blue = $chroma;
        } else {
            $red = $chroma;
            $green = 0;
            $blue = $intermediate;
        }

        $match = $luminosity - $chroma / 2;
        $red = round(($red + $match) * 255);
        $green = round(($green + $match) * 255);
        $blue = round(($blue + $match) * 255);

        return [
            'red' => (int) floor($red),
            'green' => (int) floor($green),
            'blue' => (int) floor($blue),
        ];
    }

    /**
     * @param int $red
     * @param int $green
     * @param int $blue
     *
     * @return array
     */
    public static function rgbToHsl(int $red, int $green, int $blue)
    {
        $red /= 255;
        $green /= 255;
        $blue /= 255;
        $max = max($red, $green, $blue);
        $min = min($red, $green, $blue);
        $luminosity = ($max + $min) / 2;
        if ($max == $min) {
            $hue = $saturation = 0;
        } else {
            $difference = $max - $min;
            $saturation = $luminosity > 0.5 ? $difference / (2 - $max - $min) : $difference / ($max + $min);
            switch ($max) {
                case $red:
                    $hue = ($green - $blue) / $difference + ($green < $blue ? 6 : 0);
                    break;
                case $green:
                    $hue = ($blue - $red) / $difference + 2;
                    break;
                case $blue:
                    $hue = ($red - $green) / $difference + 4;
                    break;
            }
            $hue /= 6;
        }
        $hue = (float) round($hue * 360);
        $saturation = (int) round($saturation * 100);
        $luminosity = (int) round($luminosity * 100);

        return [
            'hue' => (float) round($hue, 2),
            'saturation' => (int) round($saturation),
            'luminosity' => (int) round($luminosity),
        ];
    }

    /**
     * @param string $hex
     *
     * @return number
     */
    public static function hexChannelToRgbChannel(string $hex)
    {
        ColorValidator::hexChannel($hex);

        return hexdec($hex);
    }

    /**
     * @param float $rgb
     *
     * @return string
     */
    public static function rgbChannelToHexChannel(float $rgb)
    {
        ColorValidator::rgbChannel($rgb);

        return dechex(round($rgb));
    }
}