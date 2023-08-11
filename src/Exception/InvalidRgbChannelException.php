<?php

namespace Gubler\Color\Exception;

class InvalidRgbChannelException extends InvalidColorException
{
    public function __construct(mixed $value)
    {
        $message = 'Invalid RGB channel value. Only values between 0 and 255 allowed. `' . $value . '` provided';
        parent::__construct($message);
    }
}
