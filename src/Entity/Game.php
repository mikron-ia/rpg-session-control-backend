<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 * @ApiResource(
 *     collectionOperations={
 *          "get"={"method"="GET"}
 *     },
 *     itemOperations={
 *          "get"={"method"="GET"}
 *     }
 * )
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Epic", inversedBy="games")
     * @ORM\JoinColumn(nullable=false)
     */
    private $epic;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getEpic(): ?Epic
    {
        return $this->epic;
    }

    public function setEpic(?Epic $epic): self
    {
        $this->epic = $epic;

        return $this;
    }

    public function __toString(): string
    {
        return $this->number;
    }
}
