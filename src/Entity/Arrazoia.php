<?php

namespace App\Entity;

use App\Repository\ArrazoiaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Intl\Locale;
use Symfony\Component\Serializer\Annotation\Groups;

#[Gedmo\Tree(type: 'nested')]
#[ORM\Table(name: 'arrazoia')]
#[ORM\Entity(repositoryClass: ArrazoiaRepository::class)]
class Arrazoia implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('list')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('list')]
    private ?string $maila_eu = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('list')]
    private ?string $maila_es = null;

    #[Gedmo\TreeLeft]
    #[ORM\Column(name: 'lft', type: 'integer')]
    private ?int $lft = null;

    #[Gedmo\TreeLevel]
    #[ORM\Column(name: 'lvl', type: 'integer')]
    #[Groups('list')]
    private ?int $lvl = null;

    #[Gedmo\TreeRight]
    #[ORM\Column(name: 'rgt', type: 'integer')]
    private ?int $rgt = null;

    #[Gedmo\TreeRoot]
    #[ORM\ManyToOne(targetEntity: Arrazoia::class)]
    #[ORM\JoinColumn(name: 'tree_root', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private ?Arrazoia $root = null;

    #[Gedmo\TreeParent]
    #[ORM\ManyToOne(targetEntity: Arrazoia::class, inversedBy: 'children')]
    #[ORM\JoinColumn(name: 'parent_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private ?Arrazoia $parent = null;

    #[ORM\OneToMany(targetEntity: 'Arrazoia', mappedBy: 'parent')]
    #[ORM\OrderBy(['lft' => 'ASC'])]
    private readonly Collection $children;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $beste_arrazoia = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $beste_babeseza = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $beste_bazterkeria = null;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMailaEu(): ?string
    {
        return $this->maila_eu;
    }

    public function setMailaEu(string $maila_eu): self
    {
        $this->maila_eu = $maila_eu;

        return $this;
    }

    public function getMailaEs(): ?string
    {
        return $this->maila_es;
    }

    public function setMailaEs(string $maila_es): self
    {
        $this->maila_es = $maila_es;

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

    public function getTitle(): ?string
    {
        if(isset($GLOBALS['request']) && $GLOBALS['request']) {
            $locale = $GLOBALS['request']->getLocale(); 
        }else{
            $locale = Locale::getDefault();
        }
        if ($locale == 'es') return $this->maila_es;
        return $this->maila_eu;
    }
    public function getName() {
        if(isset($GLOBALS['request']) && $GLOBALS['request']) {
            $locale = $GLOBALS['request']->getLocale(); 
        }else{
            $locale = Locale::getDefault();
        }
        if ($locale == 'es') return $this->maila_es;
        return $this->maila_eu;
    }
    
    public function __toString(): string {
        if(isset($GLOBALS['request']) && $GLOBALS['request']) {
            $locale = $GLOBALS['request']->getLocale(); 
        }else{
            $locale = Locale::getDefault();
        }
        if ($locale == 'es') return (string) $this->maila_es;

        return (string) $this->maila_eu;
    }

    public function getBesteArrazoia(): ?bool
    {
        return $this->beste_arrazoia;
    }

    public function setBesteArrazoia(?bool $beste_arrazoia ): self
    {
        $this->beste_arrazoia = $beste_arrazoia;

        return $this;
    }

    public function getBesteBabeseza(): ?bool
    {
        return $this->beste_babeseza;
    }

    public function setBesteBabeseza(bool $beste_babeseza): self
    {
        $this->beste_babeseza = $beste_babeseza;

        return $this;
    }

    public function getBesteBazterkeria(): ?bool
    {
        return $this->beste_bazterkeria;
    }

    public function setBesteBazterkeria(bool $beste_bazterkeria): self
    {
        $this->beste_bazterkeria = $beste_bazterkeria;

        return $this;
    }

}
