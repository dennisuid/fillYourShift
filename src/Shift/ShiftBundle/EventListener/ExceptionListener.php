<?php

namespace Shift\ShiftBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\Response;

class ExceptionListener
{

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // You get the exception object from the received event
        $exception = $event->getException();
        $message = ['code' => $exception->getCode(),
            'detail' => $exception->getMessage()
        ];

        // Customize your response object to display the exception details
        $response = new \Symfony\Component\HttpFoundation\JsonResponse();
        

        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
        if ($exception instanceof HttpExceptionInterface) {
            $message['status'] = $exception->getStatusCode();
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $response->setContent(json_encode($message));
      
        // Send the modified response object to the event
        $event->setResponse($response);
    }

}
