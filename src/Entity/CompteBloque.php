<?php

namespace App\Entity;

use App\Repository\CompteBloqueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompteBloqueRepository::class)
 */
class CompteBloque
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
    private $id_compte;

    /**
     * @ORM\Column(type="integer")
     */
    private $solde;

    /**
     * @ORM\Column(type="string")
     */
    private $date_deblocage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCompte(): ?Comptes
    {
        return $this->id_compte;
    }

    public function setIdCompte(Comptes $id_compte): self
    {
        $this->id_compte = $id_compte;

        return $this;
    }

    public function getSolde(): ?int
    {
        return $this->solde;
    }

    public function setSolde(int $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getDateDeblocage(): ?string
    {
        return $this->date_deblocage;
    }

    public function setDateDeblocage(string $date_deblocage): self
    {
        $this->date_deblocage = $date_deblocage;

        return $this;
    }
}
