<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;
class UpdatePersonRequest
{
    public ?string $name;

    #[Assert\Email(message: "Formato de email invalido!")]
    public ?string $email;

    public ?string $telephone;

}
