<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CountryRepository::class)
 */
class Country
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Hideway::class, mappedBy="country")
     */
    private $hideways;

    public function __construct()
    {
        $this->hideways = new ArrayCollection();
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

    /**
     * @return Collection|Hideway[]
     */
    public function getHideways(): Collection
    {
        return $this->hideways;
    }

    public function addHideway(Hideway $hideway): self
    {
        if (!$this->hideways->contains($hideway)) {
            $this->hideways[] = $hideway;
            $hideway->setCountry($this);
        }

        return $this;
    }

    public function removeHideway(Hideway $hideway): self
    {
        if ($this->hideways->removeElement($hideway)) {
            // set the owning side to null (unless already changed)
            if ($hideway->getCountry() === $this) {
                $hideway->setCountry(null);
            }
        }

        return $this;
    }
}
