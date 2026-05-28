<?php

namespace App\Service;

use App\Repository\PersonRepository;
use Symfony\Component\HttpFoundation\Request;

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

    public function addPerson(array $dataPerson): array
    {

    }
}
