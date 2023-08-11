<?php

namespace Gubler\Color;

use Gubler\Color\Exception\InvalidHexChannelException;
use Gubler\Color\Exception\InvalidHexColorException;
use Gubler\Color\Exception\InvalidRgbChannelException;

final class ColorConverter
{
    public const SHORT_HEX_REGEX = '/^#?([0-9a-f])([0-9a-f])([0-9a-f])$/i';
    public const LONG_HEX_REGEX = '/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i';

    private ColorValidator $validator;

    public function __construct()
    {
        $this->validator = new ColorValidator();
    }

    /**
     * @return array{'red': int, 'green': int, 'blue': int}
     *
     * @throws InvalidHexChannelException
     * @throws InvalidHexColorException
     */
    public function hexToRgb(string $hexValue): array
    {
        if (!$this->validator->isHexColorString($hexValue)) {
            throw new InvalidHexColorException($hexValue);
        }

        $matches = [];
        preg_match(self::LONG_HEX_REGEX, $hexValue, $matches);

        return [
            'red' => $this->hexChannelToRgbChannel($matches[1]),
            'green' => $this->hexChannelToRgbChannel($matches[2]),
            'blue' => $this->hexChannelToRgbChannel($matches[3]),
        ];
    }

    /**
     * @return array{'red': int, 'green': int, 'blue': int}
     */
    public function shortHexToRgb(string $hexValue): array
    {
        if (!$this->validator->isShortHex($hexValue)) {
            throw new InvalidHexColorException($hexValue);
        }

        $matches = [];
        preg_match(self::SHORT_HEX_REGEX, $hexValue, $matches);

        return [
            'red' => $this->hexChannelToRgbChannel($matches[1] . $matches[1]),
            'green' => $this->hexChannelToRgbChannel($matches[2] . $matches[2]),
            'blue' => $this->hexChannelToRgbChannel($matches[3] . $matches[3]),
        ];
    }

    public function rgbToHex(int $red, int $green, int $blue): string
    {
        $redHex = $this->rgbChannelToHexChannel($red);
        $greenHex = $this->rgbChannelToHexChannel($green);
        $blueHex = $this->rgbChannelToHexChannel($blue);

        return strtoupper('#' . $redHex . $greenHex . $blueHex);
    }

    /**
     * @return array{'red': int, 'green': int, 'blue': int}
     */
    public function hslToRgb(float $hue, int $saturation, int $luminosity): array
    {
        $hue /= 60;
        if ($hue < 0) {
            $hue = 360 + $hue;
        }

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
     * @return array{'hue': float, 'saturation': int, 'luminosity': int}
     */
    public function rgbToHsl(int $red, int $green, int $blue): array
    {
        $red /= 255;
        $green /= 255;
        $blue /= 255;
        $max = max($red, $green, $blue);
        $min = min($red, $green, $blue);
        $luminosity = ($max + $min) / 2;
        if ($max === $min) {
            $hue = $saturation = 0;
        } else {
            $difference = $max - $min;
            $saturation = $luminosity > 0.5 ? $difference / (2 - $max - $min) : $difference / ($max + $min);
            $hue = null;
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
        $hue = round($hue * 360);
        $saturation = (int) round($saturation * 100);
        $luminosity = (int) round($luminosity * 100);

        return [
            'hue' => round($hue, 2),
            'saturation' => (int) round($saturation),
            'luminosity' => (int) round($luminosity),
        ];
    }

    private function hexChannelToRgbChannel(string $hex): int
    {
        if (!$this->validator->isHexChannel($hex)) {
            throw new InvalidHexChannelException($hex);
        }

        return (int) hexdec($hex);
    }

    private function rgbChannelToHexChannel(int $rgb): string
    {
        if (!$this->validator->isRGBChannel($rgb)) {
            throw new InvalidRgbChannelException($rgb);
        }

        return str_pad(dechex($rgb), 2, '0', STR_PAD_LEFT);
    }
}
