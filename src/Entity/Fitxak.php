<?php

namespace App\Entity;

use App\Repository\FitxakRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;

use App\Validator as AcmeAssert;

#[ORM\Entity(repositoryClass: FitxakRepository::class)]
class Fitxak
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $izena = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $abizena = null;
    
    #[AcmeAssert\Dni]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $dokumentu_zenbakia = null;
    
    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $jaiotze_data = null;

    #[ORM\ManyToOne(targetEntity: Herria::class)]
    private ?Herria $herria = null;

    #[ORM\ManyToOne(targetEntity: Genero::class)]
    private ?Genero $genero = null;

    #[ORM\ManyToOne(targetEntity: Estatuak::class)]
    private ?Estatuak $estatua = null;

    #[ORM\ManyToOne(targetEntity: Bizitokia::class)]
    private ?Bizitokia $bizitokia = null;

    #[ORM\ManyToOne(targetEntity: Bizikidetza::class)]
    private ?Bizikidetza $bizikidetza = null;

    #[ORM\ManyToOne(targetEntity: Gaitasuna::class)]
    private ?Gaitasuna $gaitasuna = null;

    #[ORM\ManyToOne(targetEntity: DokumentuMota::class)]
    private ?DokumentuMota $dokumentu_mota = null;

    #[ORM\ManyToMany(targetEntity: Nazionalitatea::class)]
    private Collection|array $nazionalitatea;

    #[ORM\ManyToMany(targetEntity: Errolda::class)]
    private Collection|array $errolda;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $errolda_data = null;

    #[ORM\ManyToMany(targetEntity: Arrazoia::class)]
    private Collection|array $arrazoia;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $beste_arrazoia = null;

    #[ORM\ManyToMany(targetEntity: Balioespena::class)]
    private Collection|array $balioespena;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $beste_balioespena = null;

    #[ORM\ManyToMany(targetEntity: Eragilea::class)]
    private Collection|array $eragilea;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $beste_gaixotasun = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $beste_eragile = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $oharrak = null;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $created = null;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updated = null;

    #[Gedmo\Timestampable(on: 'change', field: ["izena", "abizena"])]
    #[ORM\Column(name: 'content_changed', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $contentChanged = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $erabiltzailea = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $beste_babes_eza = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $beste_bazterkeria = null;

    #[ORM\ManyToOne(targetEntity: Egoera::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Egoera $egoera = null;

    public function __construct()
    {
        $this->nazionalitatea = new ArrayCollection();
        $this->errolda = new ArrayCollection();
        $this->arrazoia = new ArrayCollection();
        $this->balioespena = new ArrayCollection();
        $this->eragilea = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJaiotzeData(): ?\DateTimeInterface
    {
        return $this->jaiotze_data;
    }

    public function setJaiotzeData(\DateTimeInterface $jaiotze_data): self
    {
        $this->jaiotze_data = $jaiotze_data;

        return $this;
    }

    public function getHerria(): ?Herria
    {
        return $this->herria;
    }

    public function setHerria(?Herria $herria): self
    {
        $this->herria = $herria;

        return $this;
    }

    public function getGenero(): ?Genero
    {
        return $this->genero;
    }

    public function setGenero(?Genero $genero): self
    {
        $this->genero = $genero;

        return $this;
    }


    public function getEstatua(): ?Estatuak
    {
        return $this->estatua;
    }

    public function setEstatua(?Estatuak $estatua): self
    {
        $this->estatua = $estatua;

        return $this;
    }

    public function getBizitokia(): ?Bizitokia
    {
        return $this->bizitokia;
    }

    public function setBizitokia(?Bizitokia $bizitokia): self
    {
        $this->bizitokia = $bizitokia;

        return $this;
    }

    public function getBizikidetza(): ?Bizikidetza
    {
        return $this->bizikidetza;
    }

    public function setBizikidetza(?Bizikidetza $bizikidetza): self
    {
        $this->bizikidetza = $bizikidetza;

        return $this;
    }

    public function getGaitasuna(): ?Gaitasuna
    {
        return $this->gaitasuna;
    }

    public function setGaitasuna(?Gaitasuna $gaitasuna): self
    {
        $this->gaitasuna = $gaitasuna;

        return $this;
    }
    
    public function getIzena(): ?string
    {
        return $this->izena;
    }

    public function setIzena(string $izena): self
    {
        $this->izena = $izena;

        return $this;
    }

    public function getAbizena(): ?string
    {
        return $this->abizena;
    }

    public function setAbizena(string $abizena): self
    {
        $this->abizena = $abizena;

        return $this;
    }

    public function getDokumentuZenbakia(): ?string
    {
        return $this->dokumentu_zenbakia;
    }

    public function setDokumentuZenbakia(string $dokumentu_zenbakia): self
    {
        $this->dokumentu_zenbakia = $dokumentu_zenbakia;

        return $this;
    }

    public function getDokumentuMota(): ?DokumentuMota
    {
        return $this->dokumentu_mota;
    }

    public function setDokumentuMota(?DokumentuMota $dokumentu_mota): self
    {
        $this->dokumentu_mota = $dokumentu_mota;

        return $this;
    }

    /**
     * @return Collection|Nazionalitatea[]
     */
    public function getNazionalitatea(): Collection
    {
        return $this->nazionalitatea;
    }

    public function addNazionalitatea(Nazionalitatea $nazionalitatea): self
    {
        if (!$this->nazionalitatea->contains($nazionalitatea)) {
            $this->nazionalitatea[] = $nazionalitatea;
        }

        return $this;
    }

    public function removeNazionalitatea(Nazionalitatea $nazionalitatea): self
    {
        $this->nazionalitatea->removeElement($nazionalitatea);

        return $this;
    }

    /**
     * @return Collection|Errolda[]
     */
    public function getErrolda(): Collection
    {
        return $this->errolda;
    }

    public function addErrolda(Errolda $errolda): self
    {
        if (!$this->errolda->contains($errolda)) {
            $this->errolda[] = $errolda;
        }

        return $this;
    }

    public function removeErrolda(Errolda $errolda): self
    {
        $this->errolda->removeElement($errolda);

        return $this;
    }

    public function getErroldaData(): ?\DateTimeInterface
    {
        return $this->errolda_data;
    }

    public function setErroldaData(?\DateTimeInterface $errolda_data): self
    {
        $this->errolda_data = $errolda_data;

        return $this;
    }

    /**
     * @return Collection|Arrazoia[]
     */
    public function getArrazoia(): Collection
    {
        return $this->arrazoia;
    }

    public function addArrazoium(Arrazoia $arrazoium): self
    {
        if (!$this->arrazoia->contains($arrazoium)) {
            $this->arrazoia[] = $arrazoium;
        }

        return $this;
    }

    public function removeArrazoium(Arrazoia $arrazoium): self
    {
        $this->arrazoia->removeElement($arrazoium);

        return $this;
    }

    public function getBesteArrazoia(): ?string
    {
        return $this->beste_arrazoia;
    }

    public function setBesteArrazoia(?string $beste_arrazoia): self
    {
        $this->beste_arrazoia = $beste_arrazoia;

        return $this;
    }

    /**
     * @return Collection|Balioespena[]
     */
    public function getBalioespena(): Collection
    {
        return $this->balioespena;
    }

    public function addBalioespena(Balioespena $balioespena): self
    {
        if (!$this->balioespena->contains($balioespena)) {
            $this->balioespena[] = $balioespena;
        }

        return $this;
    }

    public function removeBalioespena(Balioespena $balioespena): self
    {
        $this->balioespena->removeElement($balioespena);

        return $this;
    }

    public function getBesteBalioespena(): ?string
    {
        return $this->beste_balioespena;
    }

    public function setBesteBalioespena(?string $beste_balioespena): self
    {
        $this->beste_balioespena = $beste_balioespena;

        return $this;
    }

    /**
     * @return Collection|Eragilea[]
     */
    public function getEragilea(): Collection
    {
        return $this->eragilea;
    }

    public function addEragilea(Eragilea $eragilea): self
    {
        if (!$this->eragilea->contains($eragilea)) {
            $this->eragilea[] = $eragilea;
        }

        return $this;
    }

    public function removeEragilea(Eragilea $eragilea): self
    {
        $this->eragilea->removeElement($eragilea);

        return $this;
    }

    public function getBesteGaixotasun(): ?string
    {
        return $this->beste_gaixotasun;
    }

    public function setBesteGaixotasun(?string $beste_gaixotasun): self
    {
        $this->beste_gaixotasun = $beste_gaixotasun;

        return $this;
    }

    public function getBesteEragile(): ?string
    {
        return $this->beste_eragile;
    }

    public function setBesteEragile(?string $beste_eragile): self
    {
        $this->beste_eragile = $beste_eragile;

        return $this;
    }

    public function getOharrak(): ?string
    {
        return $this->oharrak;
    }

    public function setOharrak(?string $oharrak): self
    {
        $this->oharrak = $oharrak;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(?\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function getContentChanged(): ?\DateTimeInterface
    {
        return $this->contentChanged;
    }

    public function setContentChanged(?\DateTimeInterface $contentChanged): self
    {
        $this->contentChanged = $contentChanged;

        return $this;
    }

    public function getErabiltzailea(): ?string
    {
        return $this->erabiltzailea;
    }

    public function setErabiltzailea(string $erabiltzailea): self
    {
        $this->erabiltzailea = $erabiltzailea;

        return $this;
    }

    public function getBesteBabesEza(): ?string
    {
        return $this->beste_babes_eza;
    }

    public function setBesteBabesEza(?string $beste_babes_eza): self
    {
        $this->beste_babes_eza = $beste_babes_eza;

        return $this;
    }

    public function getBesteBazterkeria(): ?string
    {
        return $this->beste_bazterkeria;
    }

    public function setBesteBazterkeria(?string $beste_bazterkeria): self
    {
        $this->beste_bazterkeria = $beste_bazterkeria;

        return $this;
    }

    public function getEgoera(): ?Egoera
    {
        return $this->egoera;
    }

    public function setEgoera(?Egoera $egoera): self
    {
        $this->egoera = $egoera;

        return $this;
    }
}
