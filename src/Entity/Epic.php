<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EpicRepository")
 * @ApiResource(
 *     collectionOperations={
 *          "get"={"method"="GET"}
 *     },
 *     itemOperations={
 *          "get"={"method"="GET"}
 *     }
 * )
 */
class Epic
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\System", inversedBy="epics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $system;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Game", mappedBy="epic")
     */
    private $games;

    public function __construct()
    {
        $this->games = new ArrayCollection();
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

    public function getSystem(): ?System
    {
        return $this->system;
    }

    public function setSystem(?System $system): self
    {
        $this->system = $system;

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games[] = $game;
            $game->setEpic($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->contains($game)) {
            $this->games->removeElement($game);
            // set the owning side to null (unless already changed)
            if ($game->getEpic() === $this) {
                $game->setEpic(null);
            }
        }

        return $this;
    }

    public function getGameCount(): int
    {
        return count($this->games);
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
