<?php

namespace CardDetective\CardProviderDetector\Exceptions;

use Exception;

class InvalidCardNumberException extends Exception
{
    public function __construct(string $message = 'Invalid card number provided', int $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
