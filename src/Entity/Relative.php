<?php

namespace App\Entity;

use App\Repository\RelativeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RelativeRepository::class)
 */
class Relative
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
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $gender;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isUser;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $relationship;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="relatives")
     */
    private $userId;

    /**
     * @ORM\OneToMany(targetEntity=RelativeHasMedic::class, mappedBy="relativeId", cascade={"persist"})
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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getIsUser(): ?bool
    {
        return $this->isUser;
    }

    public function setIsUser(bool $isUser): self
    {
        $this->isUser = $isUser;

        return $this;
    }

    public function getRelationship(): ?string
    {
        return $this->relationship;
    }

    public function setRelationship(string $relationship): self
    {
        $this->relationship = $relationship;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

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
            $relativeHasMedic->setRelativeId($this);
        }

        return $this;
    }

    public function removeRelativeHasMedic(RelativeHasMedic $relativeHasMedic): self
    {
        if ($this->relativeHasMedics->contains($relativeHasMedic)) {
            $this->relativeHasMedics->removeElement($relativeHasMedic);
            // set the owning side to null (unless already changed)
            if ($relativeHasMedic->getRelativeId() === $this) {
                $relativeHasMedic->setRelativeId(null);
            }
        }

        return $this;
    }
}
