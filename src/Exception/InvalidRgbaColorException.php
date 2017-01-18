<?php

namespace Gubler\Color\Exception;

/**
 * Class InvalidRgbaColorException
 *
 * @package Gubler\Color\Exception
 */
class InvalidRgbaColorException extends InvalidColorException
{
    /**
     * InvalidRgbaColorException constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $message = 'Invalid RGBA color value. `'.$value.'` provided';
        parent::__construct($message);
    }
}
