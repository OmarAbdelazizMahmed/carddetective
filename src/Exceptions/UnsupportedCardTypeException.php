<?php

namespace CardDetective\CardProviderDetector\Exceptions;

use Exception;

class UnsupportedCardTypeException extends Exception
{
    public function __construct(string $message = 'Unsupported card type', int $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
