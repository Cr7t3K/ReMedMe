<?php

namespace App\Entity;

use App\Repository\RelativeHasMedicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RelativeHasMedicRepository::class)
 */
class RelativeHasMedic
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
    private $dose;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_times;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity=Medic::class, inversedBy="relativeHasMedics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $medicId;

    /**
     * @ORM\ManyToOne(targetEntity=Relative::class, inversedBy="relativeHasMedics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $relativeId;

    /**
     * @ORM\OneToMany(targetEntity=TreatmentHour::class, mappedBy="hasMedicId")
     */
    private $treatmentHours;

    public function __construct()
    {
        $this->treatmentHours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDose(): ?int
    {
        return $this->dose;
    }

    public function setDose(int $dose): self
    {
        $this->dose = $dose;

        return $this;
    }

    public function getNbTimes(): ?int
    {
        return $this->nb_times;
    }

    public function setNbTimes(int $nb_times): self
    {
        $this->nb_times = $nb_times;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getMedicId(): ?Medic
    {
        return $this->medicId;
    }

    public function setMedicId(?Medic $medicId): self
    {
        $this->medicId = $medicId;

        return $this;
    }

    public function getRelativeId(): ?Relative
    {
        return $this->relativeId;
    }

    public function setRelativeId(?Relative $relativeId): self
    {
        $this->relativeId = $relativeId;

        return $this;
    }

    /**
     * @return Collection|TreatmentHour[]
     */
    public function getTreatmentHours(): Collection
    {
        return $this->treatmentHours;
    }

    public function addTreatmentHour(TreatmentHour $treatmentHour): self
    {
        if (!$this->treatmentHours->contains($treatmentHour)) {
            $this->treatmentHours[] = $treatmentHour;
            $treatmentHour->setHasMedicId($this);
        }

        return $this;
    }

    public function removeTreatmentHour(TreatmentHour $treatmentHour): self
    {
        if ($this->treatmentHours->contains($treatmentHour)) {
            $this->treatmentHours->removeElement($treatmentHour);
            // set the owning side to null (unless already changed)
            if ($treatmentHour->getHasMedicId() === $this) {
                $treatmentHour->setHasMedicId(null);
            }
        }

        return $this;
    }
}
