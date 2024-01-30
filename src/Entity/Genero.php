<?php

namespace App\Entity;

use App\Repository\GeneroRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Intl\Locale;

#[ORM\Entity(repositoryClass: GeneroRepository::class)]
class Genero implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private ?string $genero_eu = null;

    #[ORM\Column(type: 'string', length: 50)]
    private ?string $genero_es = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGeneroEu(): ?string
    {
        return $this->genero_eu;
    }

    public function setGeneroEu(string $genero_eu): self
    {
        $this->genero_eu = $genero_eu;

        return $this;
    }

    public function getGeneroEs(): ?string
    {
        return $this->genero_es;
    }

    public function setGeneroEs(string $genero_es): self
    {
        $this->genero_es = $genero_es;

        return $this;
    }
    public function __toString(): string {
        
        if(isset($GLOBALS['request']) && $GLOBALS['request']) {
            $locale = $GLOBALS['request']->getLocale(); 
        }else{
            $locale = Locale::getDefault();
        }

        if ($locale == 'es') return (string) $this->genero_es;
        return (string) $this->genero_eu;
    }
}
