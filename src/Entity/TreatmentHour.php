<?php

namespace App\Entity;

use App\Repository\TreatmentHourRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TreatmentHourRepository::class)
 */
class TreatmentHour
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
    private $hour;

    /**
     * @ORM\ManyToOne(targetEntity=RelativeHasMedic::class, inversedBy="treatmentHours")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hasMedicId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHour(): ?string
    {
        return $this->hour;
    }

    public function setHour(string $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    public function getHasMedicId(): ?RelativeHasMedic
    {
        return $this->hasMedicId;
    }

    public function setHasMedicId(?RelativeHasMedic $hasMedicId): self
    {
        $this->hasMedicId = $hasMedicId;

        return $this;
    }
}
