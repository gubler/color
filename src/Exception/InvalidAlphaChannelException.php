<?php

namespace Gubler\Color\Exception;

/**
 * Class InvalidAlphaChannelException
 *
 * @package Gubler\Color\Exception
 */
class InvalidAlphaChannelException extends InvalidColorException
{
    /**
     * InvalidAlphaChannelException constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $message = 'Invalid alpha channel value. Only values between 0 and 1 allowed. `'.$value.'` provided';
        parent::__construct($message);
    }
}
