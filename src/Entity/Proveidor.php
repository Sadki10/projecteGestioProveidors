<?php

namespace App\Entity;

use App\Repository\ProveidorRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProveidorRepository::class)]
#[UniqueEntity(fields:['email'], message:'El correu {{ value }} ja existeix.')]
class Proveidor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'El nom del proveïdor es obligatori.')]
    private ?string $nom = null;

    #[ORM\Column(length: 128, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 12, nullable: true)]
    #[Assert\Regex(
        pattern: '/^((\+34)?\d{9})$/',
        message: 'Introdueix un número vàlid: (+34)600600600'
        )]
    private ?string $telefon = null;

    #[ORM\Column(length: 25)]
    private ?string $tipusProveidor = null;

    #[ORM\Column]
    private ?bool $actiu = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dataIntroduccio = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dataModificacio = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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

    public function getTelefon(): ?string
    {
        return $this->telefon;
    }

    public function setTelefon(?string $telefon): static
    {
        $this->telefon = $telefon;

        return $this;
    }

    public function getTipusProveidor(): ?string
    {
        return $this->tipusProveidor;
    }

    public function setTipusProveidor(string $tipusProveidor): static
    {
        $this->tipusProveidor = $tipusProveidor;

        return $this;
    }

    public function isActiu(): ?bool
    {
        return $this->actiu;
    }

    public function setActiu(bool $actiu): static
    {
        $this->actiu = $actiu;

        return $this;
    }

    public function getDataIntroduccio(): ?\DateTimeInterface
    {
        return $this->dataIntroduccio;
    }

    #[ORM\PrePersist]
    public function setDataIntroduccio(): static
    {
        $this->dataIntroduccio = new \DateTime();

        return $this;
    }

    public function getDataModificacio(): ?\DateTimeInterface
    {
        return $this->dataModificacio;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setDataModificacio(): static
    {
        $this->dataModificacio = new \DateTime();

        return $this;
    }
}
