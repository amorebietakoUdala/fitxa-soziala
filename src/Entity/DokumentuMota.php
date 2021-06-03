<?php

namespace App\Entity;

use App\Repository\DokumentuMotaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Intl\Locale;

/**
 * @ORM\Entity(repositoryClass=DokumentuMotaRepository::class)
 */
class DokumentuMota
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
    private $mota;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mota_es;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mota_eu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMota(): ?string
    {
        return $this->mota;
    }

    public function setMota(string $mota): self
    {
        $this->mota = $mota;

        return $this;
    }

    public function getMotaEs(): ?string
    {
        return $this->mota_es;
    }

    public function setMotaEs(string $mota_es): self
    {
        $this->mota_es = $mota_es;

        return $this;
    }

    public function getMotaEu(): ?string
    {
        return $this->mota_eu;
    }

    public function setMotaEu(string $mota_eu): self
    {
        $this->mota_eu = $mota_eu;

        return $this;
    }
    
    public function __toString() {
        if(isset($GLOBALS['request']) && $GLOBALS['request']) {
            $locale = $GLOBALS['request']->getLocale(); 
        }else{
            $locale = Locale::getDefault();
        }
        if ($locale == 'es') return $this->mota_es;
        return $this->mota_eu;
    }
}
