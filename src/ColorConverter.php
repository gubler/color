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

    public static function rgbToHex(int $red, int $green, int $blue): string
    {
        $redHex = self::rgbChannelToHexChannel($red);
        $greenHex = self::rgbChannelToHexChannel($green);
        $blueHex = self::rgbChannelToHexChannel($blue);

        return '#'.$redHex.$greenHex.$blueHex;
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

        $chroma = ( 1 - abs( 2 * $luminosity - 1 ) ) * $saturation;
        $intermediate = $chroma * ( 1 - abs( fmod( ( $hue / 60 ), 2 ) - 1 ) );
        $match = $luminosity - ( $chroma / 2 );
        if ( $hue < 60 ) {
            $red = $chroma;
            $green = $intermediate;
            $blue = 0;
        } else if ( $hue < 120 ) {
            $red = $intermediate;
            $green = $chroma;
            $blue = 0;
        } else if ( $hue < 180 ) {
            $red = 0;
            $green = $chroma;
            $blue = $intermediate;
        } else if ( $hue < 240 ) {
            $red = 0;
            $green = $intermediate;
            $blue = $chroma;
        } else if ( $hue < 300 ) {
            $red = $intermediate;
            $green = 0;
            $blue = $chroma;
        } else {
            $red = $chroma;
            $green = 0;
            $blue = $intermediate;
        }
        $red = ( $red + $match ) * 255;
        $green = ( $green + $match ) * 255;
        $blue = ( $blue + $match  ) * 255;

        return [
            'red' => floor($red),
            'green' => floor($green),
            'blue' => floor($blue),
        ];
    }

    public static function rgbToHsl(int $red, int $green, int $blue)
    {
        $red /= 255;
        $green /= 255;
        $blue /= 255;

        $max = max( $red, $green, $blue );
        $min = min( $red, $green, $blue );

        $hue = null;
        $saturation = null;
        $luminosity = ( $max + $min ) / 2;
        $difference = $max - $min;
        if( $difference == 0 ){
            $hue = $saturation = 0; // achromatic
        } else {
            $saturation = $difference / ( 1 - abs(2 * $luminosity - 1 ) );
            switch( $max ){
                case $red:
                    $hue = 60 * fmod( ( ( $green - $blue ) / $difference ), 6 );
                    if ($blue > $green) {
                        $hue += 360;
                    }
                    break;
                case $green:
                    $hue = 60 * ( ( $blue - $red ) / $difference + 2 );
                    break;
                case $blue:
                    $hue = 60 * ( ( $red - $green ) / $difference + 4 );
                    break;
            }
        }

        return [
            'hue' => round($hue, 2),
            'saturation' => round($saturation),
            'luminosity' => round($luminosity),
        ];
    }

    public static function hexChannelToRgbChannel(string $hex)
    {
        ColorValidator::hexChannel($hex);

        return hexdec($hex);
    }

    public static function rgbChannelToHexChannel(float $rgb)
    {
        ColorValidator::rgbChannel($rgb);

        return dechex(round($rgb));
    }
}