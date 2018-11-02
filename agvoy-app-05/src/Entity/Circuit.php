<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CircuitRepository")
 */
class Circuit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $paysDepart;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $villeDepart;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $villeArrivee;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $dureeCircuit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Etape", mappedBy="circuit", orphanRemoval=true)
     */
    private $etapes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProgrammationCircuit", mappedBy="circuit", orphanRemoval=true)
     */
    private $programmations;
    
    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $urlBackground;
    

    public function __construct()
    {
        $this->etapes = new ArrayCollection();
        $this->programmations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPaysDepart(): ?string
    {
        return $this->paysDepart;
    }

    public function setPaysDepart(?string $paysDepart): self
    {
        $this->paysDepart = $paysDepart;

        return $this;
    }

    public function getVilleDepart(): ?string
    {
        return $this->villeDepart;
    }

    public function setVilleDepart(): self
    {
        $i=0;
        while ($this->etapes[$i]->getNumeroEtape() !=1){
            $i++;   
        }
        $this->villeDepart = $this->etapes[$i]->getVilleEtape();

        return $this;
    }

    public function getVilleArrivee(): ?string
    {
        return $this->villeArrivee;
    }

    public function setVilleArrivee(): self
    {
        $max=0;
        Foreach($this->etapes as $etape){
            if ($etape->getNumeroEtape() > $max){
                $max=$etape->getNumeroEtape();
                $villeArrivee=$etape->getVilleEtape();
            }
        }
        $this->villeArrivee = $villeArrivee;

        return $this;
    }

    public function getDureeCircuit(): ?int
    {
        return $this->dureeCircuit;
    }

    public function setDureeCircuit(): self
    {
        $dureeCircuit=0;
        Foreach ($this->etapes as $etape){
            $dureeCircuit+=($etape->getNombreJours());
        }
        $this->dureeCircuit = $dureeCircuit;

        return $this;
    }

    /**
     * @return Collection|Etape[]
     */
    public function getEtapes(): Collection
    {
        return $this->etapes;
    }

    public function addEtape(Etape $etape): self
    {
        if (!$this->etapes->contains($etape)) {
            $this->etapes[] = $etape;
            $etape->setCircuit($this);
        }

        return $this;
    }

    public function removeEtape(Etape $etape): self
    {
        if ($this->etapes->contains($etape)) {
            $this->etapes->removeElement($etape);
            // set the owning side to null (unless already changed)
            if ($etape->getCircuit() === $this) {
                $etape->setCircuit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProgrammationCircuit[]
     */
    public function getProgrammations(): Collection
    {
        return $this->programmations;
    }

    public function addProgrammation(ProgrammationCircuit $programmation): self
    {
        if (!$this->programmations->contains($programmation)) {
            $this->programmations[] = $programmation;
            $programmation->setCircuit($this);
        }

        return $this;
    }

    public function removeProgrammation(ProgrammationCircuit $programmation): self
    {
        if ($this->programmations->contains($programmation)) {
            $this->programmations->removeElement($programmation);
            // set the owning side to null (unless already changed)
            if ($programmation->getCircuit() === $this) {
                $programmation->setCircuit(null);
            }
        }

        return $this;
    }
    
    public function getUrlBackground(): ?string
    {
        return $this->urlBackground;
    }
    public function __toString() {
        return (string) $this->getDescription();
    }
}
