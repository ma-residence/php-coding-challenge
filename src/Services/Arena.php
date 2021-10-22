<?php

namespace App\Services;

use App\Entity\FightInterface;

class Arena
{
    public function fight(FightInterface $fighter1, FightInterface $fighter2) :int
    {
        //Draw
        if ($fighter1->calculatePowerLevel() === $fighter2->calculatePowerLevel()) {
            return 0;
        }

        //Winner Fighter1
        if ($fighter1->calculatePowerLevel() > $fighter2->calculatePowerLevel()) {
            return 1;
        }

        //Winner Fighter2
        return -1;
    }
}