<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;

#[AsEventListener(event: KernelEvents::EXCEPTION)]
class ApiExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $statusCode = 500;

        if ($exception instanceof HttpExceptionInterface){
            $statusCode = $exception->getStatusCode();
        }

        $response = new JsonResponse([
            'error' => [
                'message' => $exception->getMessage(),
                'code' => $statusCode
            ]
        ], $statusCode);

        $event->setResponse($response);
    }
}
