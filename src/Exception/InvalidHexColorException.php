<?php

namespace Gubler\Color\Exception;

/**
 * Class InvalidHexColorException.
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
        $message = 'Invalid hex color value. Value must start with # followed by 3 or 6 characters. `'.$value.'` provided';
        parent::__construct($message);
    }
}
