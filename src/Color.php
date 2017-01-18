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

    /**
     * @param int   $red
     * @param int   $green
     * @param int   $blue
     * @param float $alpha
     */
    public function fromRgba(int $red, int $green, int $blue, float $alpha = 1.0)
    {
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
        $this->alpha = $alpha;
    }

    /**
     * @param int   $red
     * @param int   $green
     * @param int   $blue
     */
    public function fromRgb(int $red, int $green, int $blue)
    {
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
        $this->alpha = 1.0;
    }

    public function fromHex(string $hex)
    {

    }

    protected function trimHex(string $hex)
    {

    }

    /**
     * @param int $rgbValue
     * @return string
     */
    protected function rbgToHex(int $rgbValue)
    {
        return dechex($rgbValue);
    }

    /**
     * @param string $hex
     * @return number
     */
    protected function hexToRgb(string $hex)
    {
        return hexdec($hex);
    }
}
