<?php

namespace App\Entity;

use App\DTO\UpdatePersonRequest;
use App\Repository\PersonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonRepository::class)]
class Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    public function __construct(

        #[ORM\Column(length: 100)]
        private ?string $name,

        #[ORM\Column(length: 254)]
        private ?string $email,

        #[ORM\Column(length: 12)]
        private ?string $telephone,

        #[ORM\Column(length: 11, nullable: true)]
        private ?string $cpf
    )
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function toArray() : array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'cpf' => $this->cpf,
        ];
    }

    public function update(UpdatePersonRequest $data): void
    {
        $this->name = $data->name ?? $this->name;
        $this->email = $data->email ?? $this->email;
        $this->telephone = $data->telephone ?? $this->telephone;
    }
}
