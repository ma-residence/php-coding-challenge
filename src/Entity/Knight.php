<?php

namespace App\Entity;

use App\Repository\KnightRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\SerializedName;

/**
 * @ORM\Entity(repositoryClass=KnightRepository::class)
 */
class Knight extends Human implements  FightInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message = "Please enter a strength value")
     */
    private $strength;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message = "Please enter a weapon power value")
     * @SerializedName("weaponPower")
     */
    private $weaponPower;

    public function getId(): int
    {
        return $this->id;
    }

    public function getStrength(): ?int
    {
        return $this->strength;
    }

    public function setStrength(int $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getWeaponPower(): ?int
    {
        return $this->weaponPower;
    }

    public function setWeaponPower(int $weaponPower): self
    {
        $this->weaponPower = $weaponPower;

        return $this;
    }
    public function calculatePowerLevel(): int
    {
        return $this->strength + $this->weaponPower;
    }
}

