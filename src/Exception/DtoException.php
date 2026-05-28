<?php

namespace App\Exception;


use Exception;

class DtoException extends Exception
{

    private array $errors;
    public function __construct(array $errors, string $message = "Erro de validacao", int $code = 400 )
    {
        parent::__construct($message, $code);
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getStatusCode(): int
    {
        return parent::getCode();
    }
}
