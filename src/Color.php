<?php

namespace Gubler\Color;

final class Color
{
    private int $red;
    private int $green;
    private int $blue;
    private float $alpha;
    private float $hue;
    private int $saturation;
    private int $luminosity;
    private ColorConverter $converter;

    public function __construct(string $color)
    {
        $this->converter = new ColorConverter();

        $rgb = (new ColorParser($color))->toArray();
        $this->red = $rgb['red'];
        $this->green = $rgb['green'];
        $this->blue = $rgb['blue'];
        $this->alpha = $rgb['alpha'];

        $this->updateHsl();
    }

    public function __toString(): string
    {
        return $this->rgba();
    }

    public function rgba(): string
    {
        return 'rgba(' . $this->red . ', ' . $this->green . ', ' . $this->blue . ', ' . $this->alpha . ')';
    }

    public function rgb(): string
    {
        return 'rgb(' . $this->red . ', ' . $this->green . ', ' . $this->blue . ')';
    }

    public function hex(): string
    {
        return $this->converter->rgbToHex($this->red, $this->green, $this->blue);
    }

    public function hsla(): string
    {
        return 'hsla(' . $this->hue . ', ' . $this->saturation . '%, ' . $this->luminosity . '%, ' . $this->alpha . ')';
    }

    public function hsl(): string
    {
        return 'hsl(' . $this->hue . ', ' . $this->saturation . '%, ' . $this->luminosity . '%)';
    }

    /**
     * Returns a Color of black or white to contrast against current color.
     *
     * This color can be used for to determine what color to use for text on the current color.
     *
     * @return Color
     */
    public function contrastTextColor(): Color
    {
        if ($this->perceivedBrightness() > 128) {
            return new self('rgba(0, 0, 0, ' . $this->alpha . ')');
        }

        return new self('rgba(255, 255, 255, ' . $this->alpha . ')');
    }

    public function setRgba(int $red, int $green, int $blue, float $alpha = 1.0): Color
    {
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
        $this->alpha = $alpha;

        $this->updateHsl();

        return $this;
    }

    public function setHsla(float $hue, int $saturation, int $luminosity, float $alpha = 1.0): Color
    {
        $this->hue = $hue;
        $this->saturation = $saturation;
        $this->luminosity = $luminosity;
        $this->alpha = $alpha;

        $this->updateRgb();

        return $this;
    }

    public function setHex(string $hex): Color
    {
        $rgb = (new ColorParser($hex))->toArray();
        $this->red = $rgb['red'];
        $this->green = $rgb['green'];
        $this->blue = $rgb['blue'];
        $this->alpha = $rgb['alpha'];

        $this->updateHsl();

        return $this;
    }

    private function updateHsl(): void
    {
        $hsl = $this->converter->rgbToHsl($this->red, $this->green, $this->blue);

        $this->hue = $hsl['hue'];
        $this->saturation = $hsl['saturation'];
        $this->luminosity = $hsl['luminosity'];
    }

    private function updateRgb(): void
    {
        $rgb = $this->converter->hslToRgb($this->hue, $this->saturation, $this->luminosity);

        $this->red = $rgb['red'];
        $this->blue = $rgb['blue'];
        $this->green = $rgb['green'];
    }

    /**
     * Converts color to YIQ color space and determines perceived brightness
     * on a 0-255 scale.
     */
    private function perceivedBrightness(): int
    {
        return (int) floor((
            ($this->red * 299) +
            ($this->green * 587) +
            ($this->blue * 114)
        ) / 1000);
    }
}
