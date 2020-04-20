<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ORM\Table(name="Products")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $pa;

    /**
     * @ORM\Column(type="float")
     */
    private $pv;

    /**
     * @ORM\Column(type="integer")
     */
    private $tva;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="integer")
     */
    private $stkinit;

    /**
     * @ORM\Column(type="integer")
     */
    private $stkal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
     */
    private $id_category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommandRow", mappedBy="id_product")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPa(): ?float
    {
        return $this->pa;
    }

    public function setPa(float $pa): self
    {
        $this->pa = $pa;

        return $this;
    }

    public function getPv(): ?float
    {
        return $this->pv;
    }

    public function setPv(float $pv): self
    {
        $this->pv = $pv;

        return $this;
    }

    public function getTva(): ?int
    {
        return $this->tva;
    }

    public function setTva(int $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getStkinit(): ?int
    {
        return $this->stkinit;
    }

    public function setStkinit(int $stkinit): self
    {
        $this->stkinit = $stkinit;

        return $this;
    }

    public function getStkal(): ?int
    {
        return $this->stkal;
    }

    public function setStkal(int $stkal): self
    {
        $this->stkal = $stkal;

        return $this;
    }

    public function getIdCategory(): ?Category
    {
        return $this->id_category;
    }

    public function setIdCategory(?Category $id_category): self
    {
        $this->id_category = $id_category;

        return $this;
    }

    /**
     * @return Collection|Command[]
     */
    public function getCommandRows(): Collection
    {
        return $this->commandRows;
    }

    public function addCommandRow(CommandRow $commandRow): self
    {
        if (!$this->commandRows->contains($commandRow)) {
            $this->commandRow[] = $commandRow;
            $commandRow->setIdProduct($this);
        }

        return $this;
    }

    public function removeCommandRow(CommandRow $commandRow): self
    {
        if ($this->commandRows->contains($commandRow)) {
            $this->commandRows->removeElement($commandRow);
            // set the owning side to null (unless already changed)
            if ($commandRow->getIdProduct() === $this) {
                $commandRow->setIdProduct(null);
            }
        }

        return $this;
    }
}
