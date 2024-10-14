<?php

namespace App\Services\Riot\Data\Responses;

use App\Services\Riot\Enums\QueueEnum;
use App\Services\Riot\Enums\RankEnum;
use App\Services\Riot\Enums\TierEnum;
use Spatie\LaravelData\Data;

class LeagueEntryData extends Data
{
    public function __construct(
        public readonly ?string $leagueId,
        public readonly QueueEnum $queueType,
        public readonly ?TierEnum $tier,
        public readonly ?RankEnum $rank,
        public readonly string $summonerId,
        public readonly int $wins,
        public readonly int $losses,
        public readonly bool $hotStreak,
        public readonly bool $veteran,
        public readonly bool $freshBlood,
        public readonly bool $inactive,
        public readonly ?MiniSeriesData $miniSeries,
    ) {}
}
