<?php

namespace ExerciseBundle\Services;

/**
 * Class Arena
 *
 * @package ExerciseBundle\Services
 */
class Arena
{

    /**
     * @param $firstFighter
     * @param $secondFighter
     */
    public function fight($firstFighter, $secondFighter)
    {
        if ($firstFighter->calculatePowerLevel() > $secondFighter->calculatePowerLevel()) {
            return $firstFighter;
        } else if ($secondFighter->calculatePowerLevel() > $firstFighter->calculatePowerLevel()) {
            return $secondFighter;
        }
        
        return 0;
    }
}
