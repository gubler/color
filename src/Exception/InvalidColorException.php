<?php

namespace Gubler\Color\Exception;

/**
 * Class InvalidColorException
 *
 * @package Gubler\Color\Exception
 */
class InvalidColorException extends \Exception
{
    /**
     * InvalidColorException constructor.
     *
     * @param string $message
     * @param int    $code
     */
    public function __construct(string $message = 'Invalid Color Provided', int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
