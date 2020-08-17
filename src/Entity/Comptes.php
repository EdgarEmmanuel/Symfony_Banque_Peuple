<?php

namespace App\Entity;

use App\Repository\ComptesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ComptesRepository::class)
 */
class Comptes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $date_ouverture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $num_compte;

    /**
     * @ORM\Column(type="integer")
     */
    private $cle_rib;

    /**
     * @ORM\ManyToOne(targetEntity=Clients::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idClient;

    /**
     * @ORM\ManyToOne(targetEntity=Agences::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idAgence;

    /**
     * @ORM\ManyToOne(targetEntity=ResponsableCompte::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_respo_compte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateOuverture(): ?\DateTimeInterface
    {
        return $this->date_ouverture;
    }

    public function setDateOuverture(string $date_ouverture): self
    {
        $this->date_ouverture = $date_ouverture;

        return $this;
    }

    public function getNumCompte(): ?string
    {
        return $this->num_compte;
    }

    public function setNumCompte(string $num_compte): self
    {
        $this->num_compte = $num_compte;

        return $this;
    }

    public function getCleRib(): ?int
    {
        return $this->cle_rib;
    }

    public function setCleRib(int $cle_rib): self
    {
        $this->cle_rib = $cle_rib;

        return $this;
    }

    public function getIdClient(): ?Clients
    {
        return $this->idClient;
    }

    public function setIdClient(?Clients $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }

    public function getIdAgence(): ?Agences
    {
        return $this->idAgence;
    }

    public function setIdAgence(?Agences $idAgence): self
    {
        $this->idAgence = $idAgence;

        return $this;
    }

    public function getIdRespoCompte(): ?ResponsableCompte
    {
        return $this->id_respo_compte;
    }

    public function setIdRespoCompte(?ResponsableCompte $id_respo_compte): self
    {
        $this->id_respo_compte = $id_respo_compte;

        return $this;
    }
}
