<?php

namespace App\Tests\Entity;

use App\DTO\UpdatePersonRequest;
use App\Entity\Person;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    private Person $person;

    protected function setUp(): void
    {
        $this->person = new Person(
          'caio',
          'caio@email.com',
          '47895623',
          '12345678912'
        );
    }

    public function testUpdateSuccessCase1()
    {
        $name = 'teste';
        $email = 'teste@email.com';
        $telephone = '47992609442';
        $cpf =  '12096366976';
        $personExpected = new Person($name, $email, $telephone, $cpf);

        $request = new UpdatePersonRequest();
        $request->name = $name;
        $request->email = $email;
        $request->telephone = $telephone;

        $this->person->update($request);

        $this->assertSame($personExpected->getName(), $this->person->getName());
        $this->assertSame($personExpected->getEmail(), $this->person->getEmail());
        $this->assertSame($personExpected->getTelephone(), $this->person->getTelephone());

    }

    public function testUpdateSuccessCase2()
    {
        $name = 'teste';
        $email = $this->person->getEmail();
        $telephone = $this->person->getTelephone();
        $cpf =  $this->person->getCpf();
        $personExpected = new Person($name, $email, $telephone, $cpf);

        $request = new UpdatePersonRequest();
        $request->name = $name;

        $this->person->update($request);

        $this->assertSame($personExpected->getName(), $this->person->getName());
        $this->assertSame($personExpected->getEmail(), $this->person->getEmail());
        $this->assertSame($personExpected->getTelephone(), $this->person->getTelephone());

    }
}
