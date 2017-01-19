<?php

namespace Gubler\Color\Exception;

/**
 * Class InvalidHueChannelException
 *
 * @package Gubler\Color\Exception
 */
class InvalidHueChannelException extends InvalidColorException
{
    /**
     * InvalidHueChannelException constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $message = 'Invalid hue channel value. Only float values allowed. `'.$value.'` provided';
        parent::__construct($message);
    }
}
