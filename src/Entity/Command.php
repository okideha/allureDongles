<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandRepository")
 * @ORM\Table(name="Commands")
 */
class Command
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * @ORM\Column(type="integer")
     */
    private $numComm;

    /**
     * @ORM\Column(type="integer")
     */
    private $dateComm;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="commands")
     */
    private $id_client;

    /**
     * @ORM\Column(type="float")
     */
    private $totalHT;

    /**
     * @ORM\Column(type="float")
     */
    private $totalTVA;

    /**
     * @ORM\Column(type="float")
     */
    private $totalTTC;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommandRow", mappedBy="id_command")
     */
    private $commandRows;

    public function __construct()
    {
        $this->commandRows = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumComm(): ?int
    {
        return $this->numComm;
    }

    public function setNumComm(int $numComm): self
    {
        $this->numComm = $numComm;

        return $this;
    }
    public function getDateComm(): ?int
    {
        return $this->dateComm;
    }

    public function setDateComm(int $dateComm): self
    {
        $this->dateComm = $dateComm;

        return $this;
    }

    public function getIdClient(): ?Client
    {
        return $this->id_client;
    }

    public function setIdClient(?Client $id_client): self
    {
        $this->id_client = $id_client;

        return $this;
    }

    public function getTotalHT(): ?float
    {
        return $this->totalHT;
    }

    public function setTotalHT(float $totalHT): self
    {
        $this->totalHT = $totalHT;

        return $this;
    }

    public function getTotalTVA(): ?float
    {
        return $this->totalTVA;
    }

    public function setTotalTVA(float $totalTVA): self
    {
        $this->totalTVA = $totalTVA;

        return $this;
    }

    public function getTotalTTC(): ?float
    {
        return $this->totalTTC;
    }

    public function setTotalTTC(float $totalTTC): self
    {
        $this->totalTTC = $totalTTC;

        return $this;
    }


    /**
     * @return Collection|CommandRow[]
     */
    public function getCommandRows(): Collection
    {
        return $this->commandRows;
    }

    public function addCommandRow(CommandRow $commandRow): self
    {
        if (!$this->commandRows->contains($commandRow)) {
            $this->commandRows[] = $commandRow;
            $commandRow->setIdCommand($this);
        }

        return $this;
    }

    public function removeCommandRow(CommandRow $commandRow): self
    {
        if ($this->commandRows->contains($commandRow)) {
            $this->commandRows->removeElement($commandRow);
            // set the owning side to null (unless already changed)
            if ($commandRow->getIdCommand() === $this) {
                $commandRow->setIdCommand(null);
            }
        }

        return $this;
    }
}
