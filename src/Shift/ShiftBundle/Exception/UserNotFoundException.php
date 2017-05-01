<?php

namespace Shift\ShiftBundle\Exception;

use Shift\ShiftBundle\Exception\HttpException;
use Shift\ShiftBundle\Exception\ErrorCodes;

class UserNotFoundException extends HttpException
{
    public $statusCode;

    public function __construct($message, $statusCode, $code = ErrorCodes::USER_NOT_FOUND)
    {
        $this->statusCode = $statusCode;
        parent::__construct($message, $code, null);
    }
}
