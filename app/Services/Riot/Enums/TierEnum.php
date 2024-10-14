<?php

namespace App\Services\Riot\Enums;

enum TierEnum: string
{
    case IRON = 'IRON';
    case BRONZE = 'BRONZE';
    case SILVER = 'SILVER';
    case GOLD = 'GOLD';
    case PLATINUM = 'PLATINUM';
    case EMERALD = 'EMERALD';
    case DIAMOND = 'DIAMOND';
    case MASTER = 'MASTER';
    case GRANDMASTER = 'GRANDMASTER';
    case CHALLENGER = 'CHALLENGER';
}
