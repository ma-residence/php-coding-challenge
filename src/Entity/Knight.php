<?php

namespace App\Entity;

use App\Repository\KnightRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KnightRepository::class)
 */
class Knight implements FightInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $weaponPower;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $strength;

    public function __construct(?string $name, int $strength=0, $weaponPower=0)
    {
        if ($name) {
            $this->setName($name);
        }
        $this->setStrength($strength);
        $this->setWeaponPower($weaponPower);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?int
    {
        return $this->name;
    }

    public function setName(?int $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getWeaponPower(): ?int
    {
        return $this->weaponPower;
    }

    public function setWeaponPower(?int $weaponPower): self
    {
        $this->weaponPower = $weaponPower;

        return $this;
    }

    public function calculatePowerLevel(): int
    {
        return $this->getWeaponPower() + $this->getStrength();
    }

    public function getStrength(): ?int
    {
        return $this->strength;
    }

    public function setStrength(?int $strength): self
    {
        $this->strength = $strength;

        return $this;
    }
}
