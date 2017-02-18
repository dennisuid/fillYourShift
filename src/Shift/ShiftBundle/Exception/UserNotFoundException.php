<?php

namespace Shift\ShiftBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Shift\ShiftBundle\Exception\ErrorCodes;

class UserNotFoundException extends \Exception implements HttpExceptionInterface
{

    public $statusCode;
    public $headers;

    public function __construct($message,
            $statusCode, 
            $code = ErrorCodes::USER_NOT_FOUND, 
            $headers = [])
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        parent::__construct($message, $code, null);
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

}
