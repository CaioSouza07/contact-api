<?php

namespace App\Controller;

use App\Service\PersonService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class PersonController extends AbstractController
{

    public function __construct(
        private PersonService $personService
    )
    {
    }

    #[Route('/person', name: 'app_person', methods: 'GET')]
    public function getAll(): JsonResponse
    {
        return $this->json($this->personService->getAll());
    }

}
