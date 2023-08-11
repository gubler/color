<?php

namespace Gubler\Color;

use Gubler\Color\Exception\InvalidColorException;

class ColorValidator
{
    /**
     * Checks if a string is a valid color.
     */
    public function check(string $color): bool
    {
        // parse determines the color type and checks the validity of the color
        // values (using other methods in this class) or throws an InvalidColorException.
        // So we might was well just use that. If the parsing doesn't throw an error, then
        // the color is valid. Otherwise, trap the exception and return false.

        try {
            (new ColorParser($color))->colorType();
        } catch (InvalidColorException) {
            return false;
        }

        return true;
    }

    /**
     * Validate that a hex channel falls within 00-FF (case insensitive).
     */
    public function isHexChannel(string $hex): bool
    {
        return preg_match(ColorValues::HEX_CHANNEL_REGEX, $hex) === 1;
    }

    public function isRGBChannel(int $rgb): bool
    {
        return $rgb >= ColorValues::RGB_CHANNEL_MIN
            && $rgb <= ColorValues::RGB_CHANNEL_MAX;
    }

    public function isPercentChannel(string $rgb): bool
    {
        // check for 0%-100%
        if (str_ends_with($rgb, '%')) {
            $percent = (int) $rgb;

            if ($percent >= 0 && $percent <= 100) {
                return true;
            }
        }

        return false;
    }

    public function isAlphaChannel(float $alpha): bool
    {
        return $alpha >= ColorValues::ALPHA_CHANNEL_MIN
            && $alpha <= ColorValues::ALPHA_CHANNEL_MAX;
    }

    public function isHexColorString(string $hex): bool
    {
        $matches = [];
        preg_match(ColorValues::LONG_HEX_REGEX, $hex, $matches);
        if (count($matches) !== 4) {
            return false;
        }

        return $this->isHexChannel($matches[1])
            && $this->isHexChannel($matches[2])
            && $this->isHexChannel($matches[3]);
    }

    public function isShortHex(string $hex): bool
    {
        $matches = [];
        preg_match(ColorValues::SHORT_HEX_REGEX, $hex, $matches);

        if (count($matches) !== 4) {
            return false;
        }

        return $this->isHexChannel($matches[1] . $matches[1])
            && $this->isHexChannel($matches[2] . $matches[2])
            && $this->isHexChannel($matches[3] . $matches[3]);
    }

    public function isRGB(string $rgb): bool
    {
        $matches = [];
        preg_match(ColorValues::RGB_REGEX, $rgb, $matches);

        if (count($matches) !== 4) {
            return false;
        }

        return $this->isRGBChannel((int) $matches[1])
            && $this->isRGBChannel((int) $matches[2])
            && $this->isRGBChannel((int) $matches[3]);
    }

    public function isRGBA(string $rgba): bool
    {
        $matches = [];
        preg_match(ColorValues::RGBA_REGEX, $rgba, $matches);

        if (count($matches) !== 5) {
            return false;
        }

        return $this->isRGBChannel((int) $matches[1])
            && $this->isRGBChannel((int) $matches[2])
            && $this->isRGBChannel((int) $matches[3])
            && $this->isAlphaChannel((float) $matches[4]);
    }

    public function isRGBPercent(string $rgb): bool
    {
        $matches = [];
        preg_match(ColorValues::RGB_PERCENT_REGEX, $rgb, $matches);

        if (count($matches) !== 4) {
            return false;
        }

        return $this->isPercentChannel($matches[1])
            && $this->isPercentChannel($matches[2])
            && $this->isPercentChannel($matches[3]);
    }

    public function isRGBAPercent(string $rgba): bool
    {
        $matches = [];
        preg_match(ColorValues::RGBA_PERCENT_REGEX, $rgba, $matches);

        if (count($matches) !== 5) {
            return false;
        }

        return $this->isPercentChannel($matches[1])
            && $this->isPercentChannel($matches[2])
            && $this->isPercentChannel($matches[3])
            && $this->isAlphaChannel((float) $matches[4]);
    }

    public function isHSL(string $hsl): bool
    {
        $matches = [];
        preg_match(ColorValues::HSL_REGEX, $hsl, $matches);

        if (count($matches) !== 4) {
            return false;
        }

        return is_numeric($matches[1])
            && $this->isPercentChannel($matches[2])
            && $this->isPercentChannel($matches[3]);
    }

    public function isHSLA(string $hsla): bool
    {
        $matches = [];
        preg_match(ColorValues::HSLA_REGEX, $hsla, $matches);

        if (count($matches) !== 5) {
            return false;
        }

        return is_numeric($matches[1])
            && $this->isPercentChannel($matches[2])
            && $this->isPercentChannel($matches[3])
            && $this->isAlphaChannel((float) $matches[4]);
    }
}
