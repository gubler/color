<?php

namespace Gubler\Color\Exception;

/**
 * Class InvalidPercentChannelException
 *
 * @package Gubler\Color\Exception
 */
class InvalidPercentChannelException extends InvalidColorException
{
    /**
     * InvalidPercentChannelException constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $message = 'Invalid percent channel value. Only values 0%-100% allowed. `'.$value.'` provided';
        parent::__construct($message);
    }
}
