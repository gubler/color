<?php

namespace Gubler\Color;

/**
 * Class Converter
 *
 * @package Gubler\Color
 */
class ColorConverter
{
    public static function hexToRgb(string $hexValue)
    {
        ColorValidator::hex($hexValue);

        #TODO: Implement
    }

    public static function rgbToHex(string $rgb)
    {
        ColorValidator::rgb($rgb);


        #TODO: Implement
    }

    public static function hexChannelToRgbChannel(string $hex)
    {
        ColorValidator::hexChannel($hex);

        return hexdec($hex);
    }

    public static function rgbChannelToHexChannel(int $rgb)
    {
        ColorValidator::rgbChannel($rgb);

        return dechex($rgb);
    }
}
