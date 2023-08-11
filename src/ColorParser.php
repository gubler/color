<?php

namespace Gubler\Color;

use Gubler\Color\Exception\InvalidColorException;

final class ColorParser
{
    private int $red;
    private int $green;
    private int $blue;
    private float $alpha;
    private ColorValidator $validator;
    private ColorConverter $converter;

    public function __construct(public string $color)
    {
        $this->validator = new ColorValidator();
        $this->converter = new ColorConverter();

        $this->parse($color);
    }

    /**
     * Return an array of RGBA values.
     *
     * @return array{'red': int, 'blue': int, 'green': int, 'alpha': float}
     */
    public function toArray(): array
    {
        return [
            'red' => $this->red,
            'green' => $this->green,
            'blue' => $this->blue,
            'alpha' => $this->alpha,
        ];
    }

    /**
     * Parse a CSS color string for type.
     *
     * This also checks that the color values are valid for the type.
     *
     * @throws InvalidColorException if string does not match a recognized color type
     */
    public function colorType(): ColorType
    {
        if ($this->validator->isRGB($this->color)) {
            return ColorType::RGB;
        }

        if ($this->validator->isRGBA($this->color)) {
            return ColorType::RGBA;
        }

        if ($this->validator->isRGBPercent($this->color)) {
            return ColorType::RGB_PERCENT;
        }

        if ($this->validator->isRGBAPercent($this->color)) {
            return ColorType::RGBA_PERCENT;
        }

        if ($this->validator->isHSL($this->color)) {
            return ColorType::HSL;
        }

        if ($this->validator->isHSLA($this->color)) {
            return ColorType::HSLA;
        }

        if ($this->validator->isHexColorString($this->color)) {
            return ColorType::HEX;
        }

        if ($this->validator->isShortHex($this->color)) {
            return ColorType::SHORT_HEX;
        }

        throw new InvalidColorException('Unrecognized color. `' . $this->color . '` provided.');
    }

    public function parse(string $color): void
    {
        match ($this->colorType()) {
            ColorType::RGB => $this->parseRgb($color),
            ColorType::RGB_PERCENT => $this->parseRgbPercent($color),
            ColorType::RGBA => $this->parseRgba($color),
            ColorType::RGBA_PERCENT => $this->parseRgbaPercent($color),
            ColorType::HEX => $this->parseHex($color),
            ColorType::SHORT_HEX => $this->parseShortHex($color),
            ColorType::HSL => $this->parseHsl($color),
            ColorType::HSLA => $this->parseHsla($color),
        };
    }

    private function parseRgb(string $color): void
    {
        $matches = [];
        preg_match(ColorValues::RGB_REGEX, $color, $matches);

        $this->red = (int) $matches[1];
        $this->green = (int) $matches[2];
        $this->blue = (int) $matches[3];
        $this->alpha = 1.0;
    }

    private function parseRgba(string $color): void
    {
        $matches = [];
        preg_match(ColorValues::RGBA_REGEX, $color, $matches);

        $this->red = (int) $matches[1];
        $this->green = (int) $matches[2];
        $this->blue = (int) $matches[3];
        $this->alpha = (float) $matches[4];
    }

    private function parseRgbPercent(string $color): void
    {
        $matches = [];
        preg_match(ColorValues::RGB_PERCENT_REGEX, $color, $matches);

        $this->red = $this->rgbValue($matches[1]);
        $this->green = $this->rgbValue($matches[2]);
        $this->blue = $this->rgbValue($matches[3]);
        $this->alpha = 1.0;
    }

    private function parseRgbaPercent(string $color): void
    {
        $matches = [];
        preg_match(ColorValues::RGBA_PERCENT_REGEX, $color, $matches);

        $this->red = $this->rgbValue($matches[1]);
        $this->green = $this->rgbValue($matches[2]);
        $this->blue = $this->rgbValue($matches[3]);
        $this->alpha = (float) $matches[4];
    }

    private function parseHsl(string $color): void
    {
        $matches = [];
        preg_match(ColorValues::HSL_REGEX, $color, $matches);

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

    private function parseHsla(string $color): void
    {
        $matches = [];
        preg_match(ColorValues::HSLA_REGEX, $color, $matches);

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

    private function parseHex(string $color): void
    {
        $rgb = $this->converter->hexToRgb($color);

        $this->red = $rgb['red'];
        $this->green = $rgb['green'];
        $this->blue = $rgb['blue'];
        $this->alpha = 1.0;
    }

    private function parseShortHex(string $color): void
    {
        $rgb = $this->converter->shortHexToRgb($color);

        $this->red = $rgb['red'];
        $this->green = $rgb['green'];
        $this->blue = $rgb['blue'];
        $this->alpha = 1.0;
    }

    /**
     * Convert a 0%-100% value to 0-255 value for RGB.
     */
    private function rgbValue(string $value): int
    {
        $percent = (int) $value;

        return (int) round($percent * 2.55);
    }
}
