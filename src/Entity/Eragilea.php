<?php

namespace App\Entity;

use App\Repository\EragileaRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Intl\Locale;

 
#[Gedmo\Tree(type: 'nested')]
#[ORM\Table(name: 'eragilea')]
#[ORM\Entity(repositoryClass: EragileaRepository::class)]
class Eragilea implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $eragilea_eu = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $eragilea_es = null;

    #[Gedmo\TreeLeft]
    #[ORM\Column(name: 'lft', type: 'integer')]
    private ?int $lft = null;

    #[Gedmo\TreeLevel]
    #[ORM\Column(name: 'lvl', type: 'integer')]
    private ?int $lvl = null;

    #[Gedmo\TreeRight]
    #[ORM\Column(name: 'rgt', type: 'integer')]
    private ?int $rgt = null;

    #[ORM\ManyToOne(targetEntity: Eragilea::class)]
    #[ORM\JoinColumn(name: 'tree_root', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private ?Eragilea $root = null;
       
    #[Gedmo\TreeParent]
    #[ORM\ManyToOne(targetEntity: Eragilea::class, inversedBy: 'children')]
    #[ORM\JoinColumn(name: 'parent_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private ?Eragilea $parent = null;

    #[ORM\OneToMany(targetEntity: 'Eragilea', mappedBy: 'parent')]
    #[ORM\OrderBy(['lft' => 'ASC'])]
    private $children;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $beste_gaixotasun = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $beste_eragile = null;

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
    
    public function __toString(): string {
        if(isset($GLOBALS['request']) && $GLOBALS['request']) {
            $locale = $GLOBALS['request']->getLocale(); 
        }else{
            $locale = Locale::getDefault();
        }
        if ($locale == 'es') return (string) $this->eragilea_es;
        return (string) $this->eragilea_eu;
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
