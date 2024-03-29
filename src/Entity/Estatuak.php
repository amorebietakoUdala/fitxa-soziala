<?php

namespace App\Entity;

use App\Repository\EstatuakRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: EstatuakRepository::class)]
class Estatuak implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $estatua = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $kodea = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstatua(): ?string
    {
        return $this->estatua;
    }

    public function setEstatua(string $estatua): self
    {
        $this->estatua = $estatua;

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

        return (string) $this->estatua;
    }
}
