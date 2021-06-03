<?php

namespace App\Entity;

use App\Repository\EragileaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Intl\Locale;

 
/**
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="eragilea")
 * use repository for handy tree functions
 * @ORM\Entity(repositoryClass="App\Repository\EragileaRepository")
 */
class Eragilea
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
    private $eragilea_eu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eragilea_es;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    private $rgt;

         
    /**
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity=Eragilea::class)
     * @ORM\JoinColumn(name="tree_root", referencedColumnName="id", onDelete="CASCADE")
     */
    private $root;
       
    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity=Eragilea::class, inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

         
    /**
     * @ORM\OneToMany(targetEntity="Eragilea", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
     
    private $children;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $beste_gaixotasun;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $beste_eragile;

    
   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEragileaEu(): ?string
    {
        return $this->eragilea_eu;
    }
    
    public function geteragilea_eu(): ?string
    {
        return $this->eragilea_eu;
    }


    public function setEragileaEu(string $eragilea_eu): self
    {
        $this->eragilea_eu = $eragilea_eu;

        return $this;
    }
    
    public function getTitle(): ?string
    {
        return $this->eragilea_eu;
    }

    public function getEragileaEs(): ?string
    {
        return $this->eragilea_es;
    }
    
    public function geteragilea_es(): ?string
    {
        return $this->eragilea_es;
    }

    public function setEragileaEs(string $eragilea_es): self
    {
        $this->eragilea_es = $eragilea_es;

        return $this;
    }

    public function getLft(): ?int
    {
        return $this->lft;
    }

    public function setLft(int $lft): self
    {
        $this->lft = $lft;

        return $this;
    }

    public function getLvl(): ?int
    {
        return $this->lvl;
    }

    public function setLvl(int $lvl): self
    {
        $this->lvl = $lvl;

        return $this;
    }

    public function getRgt(): ?int
    {
        return $this->rgt;
    }

    public function setRgt(int $rgt): self
    {
        $this->rgt = $rgt;

        return $this;
    }

    public function getRoot(): ?self
    {
        return $this->root;
    }

    public function setRoot(?self $root): self
    {
        $this->root = $root;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }
    
    public function getParentID(): ?int
    {
        $pid=null;
        $p=$this->getParent();
        if ($p) $pid=$p->getId();
        return $pid;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }
    
    public function getChildren()
    {
        return $this->children;
    }

    
    public function getName() {
        if(isset($GLOBALS['request']) && $GLOBALS['request']) {
            $locale = $GLOBALS['request']->getLocale(); 
        }else{
            $locale = Locale::getDefault();
        }
        if ($locale == 'es') return $this->eragilea_es;
        return $this->eragilea_eu;
    }
    
    public function __toString() {
        if(isset($GLOBALS['request']) && $GLOBALS['request']) {
            $locale = $GLOBALS['request']->getLocale(); 
        }else{
            $locale = Locale::getDefault();
        }
        if ($locale == 'es') return $this->eragilea_es;
        return $this->eragilea_eu;
    }

    public function getBesteGaixotasun(): ?bool
    {
        return $this->beste_gaixotasun;
    }

    public function setBesteGaixotasun(?bool $beste_gaixotasun): self
    {
        $this->beste_gaixotasun = $beste_gaixotasun;

        return $this;
    }

    public function getBesteEragile(): ?bool
    {
        return $this->beste_eragile;
    }

    public function setBesteEragile(?bool $beste_eragile): self
    {
        $this->beste_eragile = $beste_eragile;

        return $this;
    }
    
}
