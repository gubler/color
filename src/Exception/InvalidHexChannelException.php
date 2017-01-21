<?php

namespace Gubler\Color\Exception;

/**
 * Class InvalidColorException.
 */
class InvalidHexChannelException extends InvalidColorException
{
    /**
     * InvalidHexChannelException constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $message = 'Invalid hex channel value. Only values between 00 and FF allowed. `'.$value.'` provided';
        parent::__construct($message);
    }
}
