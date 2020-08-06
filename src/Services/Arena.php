<?php

namespace App\Services;

use App\Entity\FightInterface;

class Arena
{
    public function fight(FightInterface $Fighter1, FightInterface $Fighter2)
    {
        if ($Fighter1->calculatePowerLevel() > $Fighter2->calculatePowerLevel()) {
            return 1;
        } elseif ($Fighter2->calculatePowerLevel() > $Fighter1->calculatePowerLevel()) {
            return -1;
        } else {
            return 0;
        }
    }
}
