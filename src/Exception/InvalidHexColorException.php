<?php

namespace Gubler\Color\Exception;

class InvalidHexColorException extends InvalidColorException
{
    public function __construct(mixed $value)
    {
        $message = 'Invalid hex color value. Value must start with # followed by 3 or 6 characters. `' . $value . '` provided';
        parent::__construct($message);
    }
}
