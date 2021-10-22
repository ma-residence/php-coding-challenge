<?php

namespace App\Handler;

class addKnightDataObject
{
    private string $name;
    private int $strength;
    private int $weaponPower;

    public function __construct(string $name, int $strength, int $weaponPower)
    {
        $this->setName($name);
        $this->setStrength($strength);
        $this->setWeaponPower($weaponPower);
    }

    public static function getInstanceFromJson(?string $data) :?self
    {
        $stdData = json_decode($data);
        if (!empty($stdData->name) && !empty($stdData->strength) && !empty($stdData->weaponPower)) {
            return new self($stdData->name, $stdData->strength, $stdData->weaponPower);
        }

        return null;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @param int $strength
     * @return addKnightDataObject
     */
    public function setStrength(int $strength): addKnightDataObject
    {
        $this->strength = $strength;
        return $this;
    }

    /**
     * @return int
     */
    public function getWeaponPower(): int
    {
        return $this->weaponPower;
    }

    /**
     * @param int $weaponPower
     * @return addKnightDataObject
     */
    public function setWeaponPower(int $weaponPower): addKnightDataObject
    {
        $this->weaponPower = $weaponPower;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return addKnightDataObject
     */
    public function setName(string $name): addKnightDataObject
    {
        $this->name = $name;
        return $this;
    }
}