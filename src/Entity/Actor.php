<?php

namespace App\Entity;

use App\Repository\ActorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActorRepository::class)]
class Actor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthDate = null;

    #[ORM\ManyToMany(targetEntity: ProgramActor::class, mappedBy: 'actor')]
    private Collection $programActors;

    public function __construct()
    {
        $this->programActors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): static
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @return Collection<int, ProgramActor>
     */
    public function getProgramActors(): Collection
    {
        return $this->programActors;
    }

    public function addProgramActor(ProgramActor $programActor): static
    {
        if (!$this->programActors->contains($programActor)) {
            $this->programActors->add($programActor);
            $programActor->addActor($this);
        }

        return $this;
    }

    public function removeProgramActor(ProgramActor $programActor): static
    {
        if ($this->programActors->removeElement($programActor)) {
            $programActor->removeActor($this);
        }

        return $this;
    }
}
