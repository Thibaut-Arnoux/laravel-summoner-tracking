<?php

namespace App\Services\Riot\Data\Responses;

use Spatie\LaravelData\Data;

class SummonerData extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly string $accountId,
        public readonly string $puuid,
        public readonly int $profileIconId,
        public readonly int $revisionDate,
        public readonly int $summonerLevel
    ) {}
}
