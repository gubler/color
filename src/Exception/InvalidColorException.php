<?php

namespace Gubler\Color\Exception;

class InvalidColorException extends \Exception
{
    public function __construct(string $message = 'Invalid Color Provided', int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
