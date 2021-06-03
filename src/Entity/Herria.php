<?php

namespace App\Entity;

use App\Repository\HerriaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Intl\Locale;


/**
 * @ORM\Entity(repositoryClass=HerriaRepository::class)
 */
class Herria
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $herria;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $kodea;

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
    public function __toString() {
        
        return $this->herria;
    }
}
