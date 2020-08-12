<?php

namespace App\Entity;

use App\Repository\ResponsableCompteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResponsableCompteRepository::class)
 */
class ResponsableCompte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $matricule;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_employe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(?string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getIdEmploye(): ?int
    {
        return $this->id_employe;
    }

    public function setIdEmploye(?int $id_employe): self
    {
        $this->id_employe = $id_employe;

        return $this;
    }
}
