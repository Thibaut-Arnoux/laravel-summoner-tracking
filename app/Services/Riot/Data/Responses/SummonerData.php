<?php

namespace App\Services\Riot\Data\Responses;

use Livewire\Wireable;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;

class SummonerData extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public readonly string $id,
        public readonly string $accountId,
        public readonly string $puuid,
        public readonly int $profileIconId,
        public readonly int $revisionDate,
        public readonly int $summonerLevel
    ) {}
}
