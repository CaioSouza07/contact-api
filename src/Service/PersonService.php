<?php

namespace App\Service;

use App\DTO\CreatePersonRequest;
use App\DTO\UpdatePersonRequest;
use App\Entity\Person;
use App\Repository\PersonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PersonService
{

    public function __construct(
        private PersonRepository $personRepository,
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function getAll(): array
    {
        return $this->personRepository->findAll();
    }

    public function addPerson(CreatePersonRequest $data): Person
    {
        $person = new Person($data->name, $data->email, $data->telephone, $data->cpf);

        $this->entityManager->persist($person);
        $this->entityManager->flush();

        return $person;
    }

    public function getById(int $id): Person
    {
        $person = $this->personRepository->findOneById($id);

        if (!$person){
            throw new NotFoundHttpException("Contato com ID informado não encontrado");
        }

        return $person;
    }

    public function deleteById(int $id): void
    {
        $person = $this->personRepository->findOneById($id);

        if (!$person){
            throw new NotFoundHttpException("Contato com ID informado não encontrado");
        }

        $this->entityManager->remove($person);
        $this->entityManager->flush();

    }

    public function updatePersonById(int $id, UpdatePersonRequest $data): Person
    {
        $person = $this->personRepository->findOneById($id);

        if (!$person){
            throw new NotFoundHttpException("Contato com ID informado não encontrado");
        }

        $person->update($data);
        $this->entityManager->flush();

        return $person;
    }
}
