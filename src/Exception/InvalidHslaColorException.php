<?php

namespace Gubler\Color\Exception;

/**
 * Class InvalidHslaColorException.
 */
class InvalidHslaColorException extends InvalidColorException
{
    /**
     * InvalidHslaColorException constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $message = 'Invalid HSLA color value. `'.$value.'` provided.';
        parent::__construct($message);
    }
}
