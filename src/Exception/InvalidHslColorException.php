<?php

namespace Gubler\Color\Exception;

/**
 * Class InvalidHslColorException
 *
 * @package Gubler\Color\Exception
 */
class InvalidHslColorException extends InvalidColorException
{
    /**
     * InvalidHslColorException constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $message = 'Invalid HSL color value. `'.$value.'` provided.';
        parent::__construct($message);
    }
}
