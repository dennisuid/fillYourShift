<?php

namespace Shift\ShiftBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class HttpException extends \Exception implements HttpExceptionInterface
{
    public $statusCode;
    public $headers;


    public function __construct($message, $code, $previous)
    {
        $this->headers = ['Content-type' => 'json'];
        parent::__construct($message, $code, $previous);
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
