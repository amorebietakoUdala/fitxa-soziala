<?php

namespace App\Entity;

use App\Repository\BalioespenaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Intl\Locale;

/**
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="balioespena")
 * use repository for handy tree functions
 * @ORM\Entity(repositoryClass="App\Repository\BalioespenaRepository")
 */
class Balioespena
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
    private $maila_eu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $maila_es;

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
     * @ORM\ManyToOne(targetEntity=Balioespena::class)
     * @ORM\JoinColumn(name="tree_root", referencedColumnName="id", onDelete="CASCADE")s)
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity=Balioespena::class, inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;


    /**
     * @ORM\OneToMany(targetEntity="Balioespena", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $beste_balioespena;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $mailan_bakarra;



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

    public function getBalioespena(): ?self
    {
        return $this->balioespena;
    }

    public function setBalioespena(?self $balioespena): self
    {
        $this->balioespena = $balioespena;

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
    
    public function __toString() {
        if(isset($GLOBALS['request']) && $GLOBALS['request']) {
            $locale = $GLOBALS['request']->getLocale(); 
        }else{
            $locale = Locale::getDefault();
        }
        if ($locale == 'es') return $this->maila_es;
        return $this->maila_eu;
    }

    public function getBesteBalioespena(): ?bool
    {
        return $this->beste_balioespena;
    }

    public function setBesteBalioespena(?bool $beste_balioespena): self
    {
        $this->beste_balioespena = $beste_balioespena;

        return $this;
    }

    public function getMailanBakarra(): ?bool
    {   
        return $this->mailan_bakarra;
    }

    public function setMailanBakarra(?bool $mailan_bakarra): self
    {
        $this->mailan_bakarra = $mailan_bakarra;

        return $this;
    }

}
