<?php

namespace App\EventListener;

use App\Exception\DtoException;
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
        $data = null;

        if ($this->isAnyInstaceOf($exception, [HttpExceptionInterface::class, DtoException::class])){
            $statusCode = $exception->getStatusCode();
        }

        if ($exception instanceof DtoException){
            $data = $exception->getErrors();
        }

        $response = new JsonResponse([
            'error' => [
                'message' => $exception->getMessage(),
                'code' => $statusCode,
                'data' => $data
            ]
        ], $statusCode);

        $event->setResponse($response);
    }

    private function isAnyInstaceOf($exception, array $exceptionVerificaveis): bool
    {
        foreach ($exceptionVerificaveis as $exceptionVerificavel){
            if (is_a($exception, $exceptionVerificavel)){
                return true;
            }
        }
        return false;
    }
}
