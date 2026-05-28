<?php

namespace App\Tests\Service;

use App\DTO\CreatePersonRequest;
use App\Entity\Person;
use App\Repository\PersonRepository;
use App\Service\PersonService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PersonServiceTest extends TestCase
{

    private PersonRepository $personRepository;
    private EntityManagerInterface $entityManager;
    private PersonService $personService;

    protected function setUp(): void
    {
        $this->personRepository = $this->createMock(PersonRepository::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);


        $this->personService = new PersonService(
            $this->personRepository,
            $this->entityManager
        );

    }
    public function testGetByIdSuccess(){

        $person = $this->createMock(Person::class);

        $this->personRepository
            ->method('findOneById')
            ->with(1)
            ->willReturn($person);

        $result = $this->personService->getById(1);

        $this->assertSame($person, $result);

    }

    public function testGetByIdNotFound(){

        $this->personRepository
            ->method('findOneById')
            ->willReturn(null);

        $this->expectException(NotFoundHttpException::class);

        $this->personService->getById(1);
    }

    public function testGetAllByParamsSuccess()
    {

        $arrayPersons = [$this->createMock(Person::class), $this->createMock(Person::class)];

        $this->personRepository
            ->method('findByParams')
            ->with([
                'name' => 'kaue da silva',
                'email' => null,
                'telephone' => null,
            ])
            ->willReturn($arrayPersons);

        $result = $this->personService->getAllByParams('kaue da silva', null, null);

        $this->assertSame($arrayPersons, $result);
    }

    public function testAddPersonSuccess()
    {

        $data = new CreatePersonRequest();
        $data->name = 'Caio';
        $data->email = 'caio@email.com';
        $data->telephone = '47992609442';
        $data->cpf = '12345678912';

        $this->entityManager
            ->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(Person::class));

        $this->entityManager
            ->expects($this->once())
            ->method('flush');

        $result = $this->personService->addPerson($data);

        $this->assertInstanceOf(Person::class, $result);

    }

}
