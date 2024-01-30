<?php

namespace App\Entity;

use App\Repository\BizikidetzaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Intl\Locale;

#[ORM\Entity(repositoryClass: BizikidetzaRepository::class)]
class Bizikidetza implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $bizikidetza_eu = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $bizikidetza_es = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBizikidetzaEu(): ?string
    {
        return $this->bizikidetza_eu;
    }

    public function setBizikidetzaEu(string $bizikidetza_eu): self
    {
        $this->bizikidetza_eu = $bizikidetza_eu;

        return $this;
    }

    public function getBizikidetzaEs(): ?string
    {
        return $this->bizikidetza_es;
    }

    public function setBizikidetzaEs(string $bizikidetza_es): self
    {
        $this->bizikidetza_es = $bizikidetza_es;

        return $this;
    }
    
    public function __toString(): string {
        if(isset($GLOBALS['request']) && $GLOBALS['request']) {
            $locale = $GLOBALS['request']->getLocale(); 
        }else{
            $locale = Locale::getDefault();
        }
        if ($locale == 'es') return (string) $this->bizikidetza_es;
        return (string) $this->bizikidetza_eu;
    }
}
