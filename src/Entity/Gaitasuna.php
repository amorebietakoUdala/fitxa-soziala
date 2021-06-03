<?php

namespace App\Entity;

use App\Repository\GaitasunaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Intl\Locale;


/**
 * @ORM\Entity(repositoryClass=GaitasunaRepository::class)
 */
class Gaitasuna
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
    private $gaitasuna_eu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gaitasuna_es;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGaitasunaEu(): ?string
    {
        return $this->gaitasuna_eu;
    }

    public function setGaitasunaEu(string $gaitasuna_eu): self
    {
        $this->gaitasuna_eu = $gaitasuna_eu;

        return $this;
    }

    public function getGaitasunaEs(): ?string
    {
        return $this->gaitasuna_es;
    }

    public function setGaitasunaEs(string $gaitasuna_es): self
    {
        $this->gaitasuna_es = $gaitasuna_es;

        return $this;
    }
    
    public function __toString() {
        if(isset($GLOBALS['request']) && $GLOBALS['request']) {
            $locale = $GLOBALS['request']->getLocale(); 
        }else{
            $locale = Locale::getDefault();
        }
        if ($locale == 'es') return $this->gaitasuna_es;
        return $this->gaitasuna_eu;
    }
}
