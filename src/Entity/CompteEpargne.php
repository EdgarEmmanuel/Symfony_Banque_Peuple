<?php

namespace App\Entity;

use App\Repository\CompteEpargneRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompteEpargneRepository::class)
 */
class CompteEpargne
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Comptes::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $compte_id;

    /**
     * @ORM\Column(type="float")
     */
    private $solde;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompteId(): ?Comptes
    {
        return $this->compte_id;
    }

    public function setCompteId(Comptes $compte_id): self
    {
        $this->compte_id = $compte_id;

        return $this;
    }

    public function getSolde(): ?float
    {
        return $this->solde;
    }

    public function setSolde(float $solde): self
    {
        $this->solde = $solde;

        return $this;
    }
}
