<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;
class CreatePersonRequest
{
    #[Assert\NotBlank(message: "O campo name está vazio!")]
    public ?string $name;

    #[Assert\NotBlank(message: "O campo email está vazio!")]
    #[Assert\Email(message: "Formato de email invalido!")]
    public ?string $email;

    #[Assert\NotBlank(message: "O campo telephone está vazio!")]
    public ?string $telephone;

    #[Assert\NotBlank(message: "O campo cpf está vazio!")]
    public ?string $cpf;
}
