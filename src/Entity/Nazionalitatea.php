<?php

namespace App\Entity;

use App\Repository\NazionalitateaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Intl\Locale;

#[Gedmo\Tree(type: 'nested')]
#[ORM\Table(name: 'nazionalitatea')]
#[ORM\Entity(repositoryClass: NazionalitateaRepository::class)]
class Nazionalitatea implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $maila_eu = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $maila_es = null;

    #[Gedmo\TreeLeft]
    #[ORM\Column(name: 'lft', type: 'integer')]
    private ?int $lft = null;

    #[Gedmo\TreeLevel]
    #[ORM\Column(name: 'lvl', type: 'integer')]
    private ?int $lvl = null;

    #[Gedmo\TreeRight]
    #[ORM\Column(name: 'rgt', type: 'integer')]
    private ?int $rgt = null;

    #[Gedmo\TreeRoot]
    #[ORM\ManyToOne(targetEntity: Nazionalitatea::class)]
    #[ORM\JoinColumn(name: 'tree_root', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private ?Nazionalitatea $root = null;

    #[Gedmo\TreeParent]
    #[ORM\ManyToOne(targetEntity: Nazionalitatea::class, inversedBy: 'children')]
    private ?Nazionalitatea $parent = null;

    #[ORM\OneToMany(targetEntity: Nazionalitatea::class, mappedBy: 'parent')]
    #[ORM\OrderBy(['lft' => 'ASC'])]
    private Collection|array $children;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $estatua = null;

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

    /**
     * @return Collection|self[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(self $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(self $child): self
    {
        if ($this->children->removeElement($child)) {
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
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

    public function getEstatua(): ?bool
    {
        return $this->estatua;
    }

    public function setEstatua(?bool $estatua): self
    {
        $this->estatua = $estatua;

        return $this;
    }
}
