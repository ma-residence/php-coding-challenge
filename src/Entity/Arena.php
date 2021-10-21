<?php

namespace App\Entity;

use App\Repository\ArenaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArenaRepository::class)
 */
class Arena
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
     * @ORM\Column(type="integer")
     */
    private $maxFighters;

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

    public function getMaxFighters(): ?int
    {
        return $this->maxFighters;
    }

    public function setMaxFighters(int $maxFighters): self
    {
        $this->maxFighters = $maxFighters;

        return $this;
    }
}
