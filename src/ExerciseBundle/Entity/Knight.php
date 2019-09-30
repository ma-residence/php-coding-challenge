<?php

namespace ExerciseBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use ExerciseBundle\Model\Human;
use ExerciseBundle\Model\FightInterface;

/**
 * Knight
 * @ORM\Table(name="knights")
 * @ORM\Entity(repositoryClass="ExerciseBundle\Repository\KnightRepository")
 */
class Knight extends Human implements FightInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="strength", type="integer", nullable=false)
     */
    private $strength;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="weapon_power", type="integer", nullable=false)
     */
    private $weaponPower;


    /**
     * Set strength
     *
     * @param integer $strength
     *
     * @return Knight
     */
    public function setStrength($strength)
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * Get strength
     *
     * @return integer
     */
    public function getStrength()
    {
        return $this->strength;
    }
    
    /**
     * Set weaponPower
     *
     * @param integer $weaponPower
     *
     * @return Knight
     */
    public function setWeaponPower($weaponPower)
    {
        $this->weaponPower = $weaponPower;

        return $this;
    }

    /**
     * Get weaponPower
     *
     * @return integer
     */
    public function getWeaponPower()
    {
        return $this->weaponPower;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Calculate the Power Level of the Fighter
     *
     * @return int
     */
    public function calculatePowerLevel()
    {
        return (int) ($this->getWeaponPower() + $this->getStrength());
    }
}