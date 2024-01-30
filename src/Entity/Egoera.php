<?php

namespace App\Entity;

use App\Repository\EgoeraRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Intl\Locale;

#[ORM\Entity(repositoryClass: EgoeraRepository::class)]
class Egoera implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private ?string $egoera_es = null;

    #[ORM\Column(type: 'string', length: 50)]
    private ?string $egoera_eu = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEgoeraEs(): ?string
    {
        return $this->egoera_es;
    }

    public function setEgoeraEs(string $egoera_es): self
    {
        $this->egoera_es = $egoera_es;

        return $this;
    }

    public function getEgoeraEu(): ?string
    {
        return $this->egoera_eu;
    }

    public function setEgoeraEu(string $egoera_eu): self
    {
        $this->egoera_eu = $egoera_eu;

        return $this;
    }

    public function __toString(): string
    {
        if (isset($GLOBALS['request']) && $GLOBALS['request']) {
            $locale = $GLOBALS['request']->getLocale();
        } else {
            $locale = Locale::getDefault();
        }
        if ($locale == 'es') return (string) $this->egoera_es;
        return (string) $this->egoera_eu;
    }
}
