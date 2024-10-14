<?php

namespace App\Services\Riot\Data\Responses;

use Spatie\LaravelData\Data;

class AccountData extends Data
{
    public function __construct(
        public readonly string $puuid,
        public readonly string $gameName,
        public readonly string $tagLine,
    ) {}
}
