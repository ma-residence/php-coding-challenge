<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Human
 *
 * To extend for the humans warrior
 *
 * @ORM\MappedSuperclass
 */
abstract class AbstractHuman
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected string $name;
    /**
     * Set name
     *
     * @param string $name
     * @return AbstractHuman
     */
    public function setName(string $name) :self
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Get name
     *
     * @return string
     */
    public function getName() :string
    {
        return $this->name;
    }
}
