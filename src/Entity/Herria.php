<?php

namespace App\Entity;

use App\Repository\HerriaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HerriaRepository::class)]
class Herria implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $herria = null;

    #[ORM\Column(type: 'string', length: 6)]
    private ?string $kodea = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHerria(): ?string
    {
        return $this->herria;
    }

    public function setHerria(string $herria): self
    {
        $this->herria = $herria;

        return $this;
    }

    public function getKodea(): ?string
    {
        return $this->kodea;
    }

    public function setKodea(string $kodea): self
    {
        $this->kodea = $kodea;

        return $this;
    }
    public function __toString(): string {
        
        return (string) $this->herria;
    }
}
