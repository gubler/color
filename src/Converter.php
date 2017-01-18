<?php

namespace Gubler\Color;

/**
 * Class Converter
 *
 * @package Gubler\Color
 */
class Converter
{
    public static function hexToRgb(string $hexValue)
    {
        #TODO: Implement
    }

    public static function rgbToHex(string $rgb)
    {
        Validator::rgb($rgb);


        #TODO: Implement
    }

    public static function hexChannelToRgbChannel(string $hex)
    {
        Validator::hexChannel($hex);

        return hexdec($hex);
    }

    public static function rgbChannelToHexChannel(int $rgb)
    {
        Validator::rgbChannel($rgb);

        return dechex($rgb);
    }
}
