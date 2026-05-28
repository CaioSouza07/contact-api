<?php

namespace App\Controller;

use App\Service\PersonService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class PersonController extends AbstractController
{

    public function __construct(
        private PersonService $personService
    )
    {
    }

    #[Route('/person', methods: 'POST')]
    public function getAll(Request $request): JsonResponse
    {
        throw new \Exception("Deu problem");
        $content = json_decode($request->getContent(), true);

        return $this->json($this->personService->getAll());
    }

//    #[Route('/person', methods: 'POST')]
//    public function addPerson(Request $request): JsonResponse
//    {
//        dd($request);
//        return $this->json($this->personService->getAll());
////        return $this->json($this->personService->addPerson());
//    }

}
