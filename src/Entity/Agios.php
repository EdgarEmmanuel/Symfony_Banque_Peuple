<?php

namespace App\Entity;

use App\Repository\AgiosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AgiosRepository::class)
 */
class Agios
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $enumeration;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_fin_contexte;

    /**
     * @ORM\Column(type="date")
     */
    private $debut_contexte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEnumeration(): ?int
    {
        return $this->enumeration;
    }

    public function setEnumeration(int $enumeration): self
    {
        $this->enumeration = $enumeration;

        return $this;
    }

    public function getDateFinContexte(): ?\DateTimeInterface
    {
        return $this->date_fin_contexte;
    }

    public function setDateFinContexte(?\DateTimeInterface $date_fin_contexte): self
    {
        $this->date_fin_contexte = $date_fin_contexte;

        return $this;
    }

    public function getDebutContexte(): ?\DateTimeInterface
    {
        return $this->debut_contexte;
    }

    public function setDebutContexte(\DateTimeInterface $debut_contexte): self
    {
        $this->debut_contexte = $debut_contexte;

        return $this;
    }
}
