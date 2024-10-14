<?php

namespace App\Services\Riot\Requests\League;

use App\Services\Riot\Enums\QueueEnum;
use App\Services\Riot\Enums\RankEnum;
use App\Services\Riot\Enums\TierEnum;
use App\Services\Riot\Requests\RiotRegionTagRequest;

class GetLeagueEntryRequest extends RiotRegionTagRequest
{
    protected string $method = 'GET';

    protected string $path = '/lol/league/v4/entries';

    public function withSummonerId(string $summonerId): self
    {
        return $this->appendPath("by-summoner/{$summonerId}");
    }

    public function withQueueTierRank(QueueEnum $queueType, TierEnum $tier, RankEnum $rank): self
    {
        return $this->appendPath("{$queueType->value}/{$tier->value}/{$rank->value}");
    }
}
