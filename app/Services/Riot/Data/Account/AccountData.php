<?php

namespace App\Services\Riot\Data\Account;

use Spatie\LaravelData\Data;

class AccountData extends Data
{
    public function __construct(
        public string $puuid,
        public string $gameName,
        public string $tagLine,
    ) {}
}
