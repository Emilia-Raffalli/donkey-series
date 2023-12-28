<?php

namespace App\Entity;

use App\Repository\ProgramRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PrePersist;

#[ORM\Entity(repositoryClass: ProgramRepository::class)]
#[ORM\HasLifecycleCallbacks] // Pour indiquer à Doctrine que je vais utiliser des méthodes de rappel de cycle de vie de l'entité, telles que PrePersist, PreUpdate, etc.
class Program
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $synopsis = null;

    // #[ORM\Column(length: 80)]
    // private ?string $country = null;

    // #[ORM\Column]
    // private ?int $year = null;

    #[ORM\ManyToOne(inversedBy: 'programs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToMany(targetEntity: ProgramActor::class, mappedBy: 'program')]
    private Collection $programActors;

    #[ORM\OneToMany(mappedBy: 'program', targetEntity: Season::class, orphanRemoval: true)]
    private Collection $seasons;

    #[ORM\Column(type: Types::STRING)]
    private $poster = null;

    #[ORM\Column(type: "datetime_immutable", options: ["default" => "CURRENT_TIMESTAMP"])]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->programActors = new ArrayCollection();
        $this->seasons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): static
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    // public function getCountry(): ?string
    // {
    //     return $this->country;
    // }

    // public function setCountry(string $country): static
    // {
    //     $this->country = $country;

    //     return $this;
    // }

    // public function getYear(): ?int
    // {
    //     return $this->year;
    // }

    // public function setYear(int $year): static
    // {
    //     $this->year = $year;

    //     return $this;
    // }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

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
            $programActor->addProgram($this);
        }

        return $this;
    }

    public function removeProgramActor(ProgramActor $programActor): static
    {
        if ($this->programActors->removeElement($programActor)) {
            $programActor->removeProgram($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Season>
     */
    public function getSeasons(): Collection
    {
        return $this->seasons;
    }

    public function addSeason(Season $season): static
    {
        if (!$this->seasons->contains($season)) {
            $this->seasons->add($season);
            $season->setProgram($this);
        }

        return $this;
    }

    public function removeSeason(Season $season): static
    {
        if ($this->seasons->removeElement($season)) {
            // set the owning side to null (unless already changed)
            if ($season->getProgram() === $this) {
                $season->setProgram(null);
            }
        }

        return $this;
    }

    public function getPoster()
    {
        return $this->poster;
    }

    public function setPoster($poster): static
    {
        $this->poster = $poster;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    #[ORM\PrePersist] //Méthode appelée automatiquement avant que l'entité ne soit persistée 
    public function setCreatedAtValue():void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

   
}
