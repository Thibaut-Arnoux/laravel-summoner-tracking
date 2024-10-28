<?php

namespace App\Services\Riot\Data\Responses;

use Livewire\Wireable;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;

class AccountData extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public readonly string $puuid,
        public readonly string $gameName,
        public readonly string $tagLine,
    ) {}
}
