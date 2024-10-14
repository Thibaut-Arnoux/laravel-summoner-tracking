<?php

namespace App\Services\Riot\Data\Responses;

use App\Services\Riot\Enums\QueueEnum;
use App\Services\Riot\Enums\TierEnum;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class LeagueData extends Data
{
    public function __construct(
        public readonly TierEnum $tier,
        public readonly string $leagueId,
        public readonly QueueEnum $queue,
        public readonly string $name,
        /** @var Collection<int, LeagueItemData> */
        public readonly Collection $entries,
    ) {}
}
