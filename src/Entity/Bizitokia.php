<?php

namespace App\Entity;

use App\Repository\BizitokiaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Intl\Locale;

/**
 * @ORM\Entity(repositoryClass=BizitokiaRepository::class)
 */
class Bizitokia
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
    private $bizitokia_eu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bizitokia_es;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBizitokiaEu(): ?string
    {
        return $this->bizitokia_eu;
    }

    public function setBizitokiaEu(string $bizitokia_eu): self
    {
        $this->bizitokia_eu = $bizitokia_eu;

        return $this;
    }

    public function getBizitokiaEs(): ?string
    {
        return $this->bizitokia_es;
    }

    public function setBizitokiaEs(string $bizitokia_es): self
    {
        $this->bizitokia_es = $bizitokia_es;

        return $this;
    }
    
    public function __toString() {

        if(isset($GLOBALS['request']) && $GLOBALS['request']) {
            $locale = $GLOBALS['request']->getLocale(); 
        }else{
            $locale = Locale::getDefault();
        }
        if ($locale == 'es') return $this->bizitokia_es;
        return $this->bizitokia_eu;
    }
}
