<?php

namespace Gubler\Color\Exception;

/**
 * Class InvalidRgbChannelException
 *
 * @package Gubler\Color\Exception
 */
class InvalidRgbChannelException extends InvalidColorException
{
    /**
     * InvalidRgbChannelException constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $message = 'Invalid RGB channel value. Only values between 0 and 255 allowed. `'.$value.'` provided';
        parent::__construct($message);
    }
}
