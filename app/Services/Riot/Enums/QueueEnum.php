<?php

namespace App\Services\Riot\Enums;

enum QueueEnum: string
{
    case RANKED_SOLO_5x5 = 'RANKED_SOLO_5x5';
    case RANKED_FLEX_SR = 'RANKED_FLEX_SR';
    case CHERRY = 'CHERRY';
}
