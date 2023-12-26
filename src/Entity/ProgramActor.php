<?php

namespace App\Entity;

use App\Repository\ProgramActorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgramActorRepository::class)]
class ProgramActor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Actor::class, inversedBy: 'programActors')]
    private Collection $actor;

    #[ORM\ManyToMany(targetEntity: Program::class, inversedBy: 'programActors')]
    private Collection $program;

    public function __construct()
    {
        $this->actor = new ArrayCollection();
        $this->program = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Actor>
     */
    public function getActor(): Collection
    {
        return $this->actor;
    }

    public function addActor(Actor $actor): static
    {
        if (!$this->actor->contains($actor)) {
            $this->actor->add($actor);
        }

        return $this;
    }

    public function removeActor(Actor $actor): static
    {
        $this->actor->removeElement($actor);

        return $this;
    }

    /**
     * @return Collection<int, Program>
     */
    public function getProgram(): Collection
    {
        return $this->program;
    }

    public function addProgram(Program $program): static
    {
        if (!$this->program->contains($program)) {
            $this->program->add($program);
        }

        return $this;
    }

    public function removeProgram(Program $program): static
    {
        $this->program->removeElement($program);

        return $this;
    }

}
