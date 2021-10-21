<?php

namespace App\Entity;

use App\Repository\KnightRepository;
use App\Entity\AbstractHuman as Human;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KnightRepository::class)
 */
class Knight extends Human implements FightInterface
{
    const API_ADD_MESSAGE_SUCCESS = 'Welcome to the round table Sir.';
    const API_ADD_MESSAGE_ERROR = 'Ouch something bad happened while dubbing this knight. Please check his virtue.';

    const API_GET_SUCCESS = 'OK';
    const API_GET_ERROR = 'KO';
    const API_GET_ERROR_NOT_FOUND = 'Hmm this is not the dro... knight you\'re looking for.';
    const API_INVALID_PAYLOAD = 'form is not valid';
    const API_MESSAGE_JSON_ONLY = 'Json only is accepted. Please check you headers';
    const API_INVALID_PAYLOAD_DATA = 'Invalid payload. Please check the sent datas';

    const API_STATUS_200 = 200;
    const API_STATUS_201 = 201;
    const API_STATUS_400 = 400;
    const API_STATUS_404 = 404;

    /**
     * @ORM\Idé
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $weaponPower;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $strength;

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
