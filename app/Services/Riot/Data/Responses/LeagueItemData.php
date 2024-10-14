<?php

namespace App\Services\Riot\Data\Responses;

use App\Services\Riot\Enums\RankEnum;
use Spatie\LaravelData\Data;

class LeagueItemData extends Data
{
    public function __construct(
        public readonly string $summonerId,
        public readonly int $leaguePoints,
        public readonly RankEnum $rank,
        public readonly int $wins,
        public readonly int $losses,
        public readonly bool $hotStreak,
        public readonly bool $veteran,
        public readonly bool $freshBlood,
        public readonly bool $inactive,
        public readonly ?MiniSeriesData $miniSeries,
    ) {}
}
