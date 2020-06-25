<?php

namespace App\Entity;

use App\Repository\MedicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MedicRepository::class)
 */
class Medic
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=RelativeHasMedic::class, mappedBy="medicId")
     */
    private $relativeHasMedics;

    public function __construct()
    {
        $this->relativeHasMedics = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|RelativeHasMedic[]
     */
    public function getRelativeHasMedics(): Collection
    {
        return $this->relativeHasMedics;
    }

    public function addRelativeHasMedic(RelativeHasMedic $relativeHasMedic): self
    {
        if (!$this->relativeHasMedics->contains($relativeHasMedic)) {
            $this->relativeHasMedics[] = $relativeHasMedic;
            $relativeHasMedic->setMedicId($this);
        }

        return $this;
    }

    public function removeRelativeHasMedic(RelativeHasMedic $relativeHasMedic): self
    {
        if ($this->relativeHasMedics->contains($relativeHasMedic)) {
            $this->relativeHasMedics->removeElement($relativeHasMedic);
            // set the owning side to null (unless already changed)
            if ($relativeHasMedic->getMedicId() === $this) {
                $relativeHasMedic->setMedicId(null);
            }
        }

        return $this;
    }
}
