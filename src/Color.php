<?php

namespace Gubler\Color;

/**
 * Class Color
 *
 * @package Gubler\Color
 */
class Color
{
    /** @var int */
    protected $red;
    /** @var int */
    protected $green;
    /** @var int */
    protected $blue;
    /** @var float */
    protected $alpha;
    /** @var float */
    protected $hue;
    /** @var int */
    protected $saturation;
    /** @var int */
    protected $luminosity;

    /** @var ColorParser */
    protected $parser;
    /** @var ColorConverter */
    protected $converter;

    // ----------------------------------------
    // CONSTRUCTOR
    // ----------------------------------------

    /**
     * Construct from string
     *
     * @param string $color
     */
    public function __construct(string $color)
    {
        $this->parser = new ColorParser();
        $this->converter = new ColorConverter();

        $rgb = $this->parser->parse($color)->toArray();
        $this->red = $rgb['red'];
        $this->green = $rgb['green'];
        $this->blue = $rgb['blue'];
        $this->alpha = $rgb['alpha'];

        $this->updateHsl();
    }

    // ----------------------------------------
    // OUTPUT
    // ----------------------------------------

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->rgba();
    }

    /**
     * @return string
     */
    public function rgba()
    {
        return 'rgba('.$this->red.', '.$this->green.', '.$this->blue.', '.$this->alpha.')';
    }

    /**
     * @return string
     */
    public function rgb()
    {
        return 'rgb('.$this->red.', '.$this->green.', '.$this->blue.')';
    }

    /**
     * @return string
     */
    public function hex()
    {
        return $this->converter->rgbToHex($this->red, $this->green, $this->blue);
    }

    /**
     * @return string
     */
    public function hsla()
    {
        return 'hsla('.$this->hue.', '.$this->saturation.'%, '.$this->luminosity.'%, '.$this->alpha.')';
    }

    /**
     * @return string
     */
    public function hsl()
    {
        return 'hsl('.$this->hue.', '.$this->saturation.'%, '.$this->luminosity.'%)';
    }

    // ----------------------------------------
    // CONTRAST TEXT COLOR
    // ----------------------------------------
    /**
     * Returns a Color of black or white to contrast against current color.
     *
     * This color can be used for to determine what color to use for text on the current color.
     *
     * @return Color
     */
    public function contrastTextColor()
    {
        if ($this->perceivedBrightness() > 128) {
            return new self('rgba(0, 0, 0, '.$this->alpha.')');
        }

        return new self('rgba(255, 255, 255, '.$this->alpha.')');
    }

    // ----------------------------------------
    // UPDATERS
    // ----------------------------------------

    /**
     * @param int   $red
     * @param int   $green
     * @param int   $blue
     * @param float $alpha
     *
     * @return Color
     */
    public function setRgba(int $red, int $green, int $blue, float $alpha = 1.0): Color
    {
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
        $this->alpha = $alpha;

        $this->updateHsl();

        return $this;
    }

    /**
     * @param float $hue
     * @param int   $saturation
     * @param int   $luminosity
     * @param float $alpha
     *
     * @return Color
     */
    public function setHsla(float $hue, int $saturation, int $luminosity, float $alpha = 1.0): Color
    {
        $this->hue = $hue;
        $this->saturation = $saturation;
        $this->luminosity = $luminosity;
        $this->alpha = $alpha;

        $this->updateRgb();

        return $this;
    }

    /**
     * @param string $hex
     *
     * @return Color
     */
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

    // ----------------------------------------
    // INTERNAL UPDATERS
    // ----------------------------------------
    protected function updateHsl()
    {
        $hsl = $this->converter->rgbToHsl($this->red, $this->green, $this->blue);

        $this->hue = $hsl['hue'];
        $this->saturation = $hsl['saturation'];
        $this->luminosity = $hsl['luminosity'];
    }

    protected function updateRgb()
    {
        $rgb = $this->converter->hslToRgb($this->hue, $this->saturation, $this->luminosity);

        $this->red = $rgb['red'];
        $this->blue = $rgb['blue'];
        $this->green = $rgb['green'];
    }

    // ----------------------------------------
    // Internal converter
    // ----------------------------------------

    /**
     * Converts color to YIQ color space and determines perceived brightness
     * on a 0-255 scale
     *
     * @return int
     */
    protected function perceivedBrightness()
    {
        return (
            ($this->red * 299) +
            ($this->green * 587) +
            ($this->blue * 114)
        ) / 1000;
    }
}
