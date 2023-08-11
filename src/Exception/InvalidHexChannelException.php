<?php

namespace Gubler\Color\Exception;

class InvalidHexChannelException extends InvalidColorException
{
    public function __construct(mixed $value)
    {
        $message = 'Invalid hex channel value. Only values between 00 and FF allowed. `' . $value . '` provided';
        parent::__construct($message);
    }
}
