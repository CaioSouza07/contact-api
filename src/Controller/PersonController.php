<?php

namespace App\Controller;

use App\DTO\CreatePersonRequest;
use App\Exception\DtoException;
use App\Service\PersonService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class PersonController extends AbstractController
{

    public function __construct(
        private PersonService $personService
    )
    {
    }

    #[Route('/person', methods: 'GET')]
    public function getAll(): JsonResponse
    {
        return $this->json($this->personService->getAll());
    }

    #[Route('/person', methods: 'POST')]
    public function addPerson(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $dtoRequest = new CreatePersonRequest();
        $dtoRequest->name = $data['name'] ?? null;
        $dtoRequest->email = $data['email'] ?? null;
        $dtoRequest->telephone = $data['telephone'] ?? null;
        $dtoRequest->cpf = $data['cpf'] ?? null;

        $errors = $validator->validate($dtoRequest);

        if (count($errors) > 0){
            $formattedErrors = [];

            foreach ($errors as $error){
                $formattedErrors[] = [
                    'field' => $error->getPropertyPath(),
                    'message' => $error->getMessage()
                ];
            }

            throw new DtoException($formattedErrors);
        }

        $newPerson = $this->personService->addPerson($dtoRequest);

        return $this->json($newPerson->toArray(), 201);

    }

}
