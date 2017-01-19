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

    // ----------------------------------------
    // CONSTRUCTORS
    // ----------------------------------------

    /**
     * Construct from string
     *
     * @param string $color
     */
    public function __construct(string $color)
    {
        $rgb = ColorParser::parse($color);
        $this->red = $rgb['red'];
        $this->green = $rgb['green'];
        $this->blue = $rgb['blue'];
        $this->alpha = $rgb['alpha'];

        $this->updateHsl();
    }

    /**
     * Static constructor from RGBA (or RGB) values
     *
     * @param int   $red
     * @param int   $green
     * @param int   $blue
     * @param float $alpha
     *
     * @return Color
     */
    public static function fromRgba(int $red, int $green, int $blue, float $alpha = 1.0)
    {
        return new self('rgba('.$red.','.$green.','.$blue.','.$alpha.')');
    }

    /**
     * Static constructor from HSLA (or HSL) values
     *
     * @param float $hue
     * @param int   $saturation
     * @param int   $luminosity
     * @param float $alpha
     *
     * @return Color
     */
    public static function fromHsla(float $hue, int $saturation, int $luminosity, float $alpha = 1.0)
    {
        return new self('hsla('.$hue.','.$saturation.'%,'.$luminosity.'%,'.$alpha.')');
    }

    /**
     * Static constructor from hex (or short hex) string
     *
     * @param string $hex
     *
     * @return Color
     */
    public static function fromHex(string $hex)
    {
        return new self($hex);
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
        return 'rgba('.$this->red.','.$this->green.','.$this->blue.','.$this->alpha.')';
    }

    /**
     * @return string
     */
    public function rgb()
    {
        return 'rgba('.$this->red.','.$this->green.','.$this->blue.')';
    }

    /**
     * @return string
     */
    public function hex()
    {
        return ColorConverter::rgbToHex($this->red, $this->green, $this->blue);
    }

    /**
     * @return string
     */
    public function hsla()
    {
        return 'hsla('.$this->hue.','.$this->saturation.','.$this->luminosity.','.$this->alpha.')';
    }

    /**
     * @return string
     */
    public function hsl()
    {
        return 'hsl('.$this->hue.','.$this->saturation.','.$this->luminosity.')';
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
        return self::fromRgba($red, $green, $blue, $alpha);
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
        return self::fromHsla($hue, $saturation, $luminosity, $alpha);
    }

    /**
     * @param string $hex
     *
     * @return Color
     */
    public function setHex(string $hex): Color
    {
        return self::fromHex($hex);
    }

    // ----------------------------------------
    // INTERNAL UPDATERS
    // ----------------------------------------
    protected function updateHsl()
    {
        $hsl = ColorConverter::rgbToHsl($this->red, $this->green, $this->blue);

        $this->hue = $hsl['hue'];
        $this->saturation = $hsl['saturation'];
        $this->luminosity = $hsl['luminosity'];
    }

    protected function updateRgb()
    {
        $rgb = ColorConverter::hslToRgb($this->hue, $this->saturation, $this->luminosity);

        $this->red = $rgb['red'];
        $this->blue = $rgb['blue'];
        $this->green = $rgb['green'];
    }
}
