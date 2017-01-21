<?php

namespace Gubler\Color\Exception;

/**
 * Class InvalidRgbColorException.
 */
class InvalidRgbColorException extends InvalidColorException
{
    /**
     * InvalidRgbColorException constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $message = 'Invalid RGB color value. `'.$value.'` provided';
        parent::__construct($message);
    }
}
