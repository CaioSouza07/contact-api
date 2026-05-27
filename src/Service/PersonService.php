<?php

namespace App\Service;

use App\Repository\PersonRepository;

class PersonService
{

    public function __construct(
        private PersonRepository $personRepository
    )
    {
    }

    public function getAll(): array
    {
        return $this->personRepository->findAll();
    }
}
