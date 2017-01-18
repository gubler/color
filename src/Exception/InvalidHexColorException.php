<?php

namespace Gubler\Color\Exception;

/**
 * Class InvalidHexColorException
 *
 * @package Gubler\Color\Exception
 */
class InvalidHexColorException extends InvalidColorException
{
    /**
     * InvalidHexColorException constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $message = 'Invalid hex color value. Value must start with # followed by 6 characters. `'.$value.'` provided';
        parent::__construct($message);
    }
}
