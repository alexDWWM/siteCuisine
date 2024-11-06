<?php

namespace App\Entity;

use App\Repository\EtapesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtapesRepository::class)]
class Etapes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Etapes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtapes(): ?string
    {
        return $this->Etapes;
    }

    public function setEtapes(string $Etapes): static
    {
        $this->Etapes = $Etapes;

        return $this;
    }
}
