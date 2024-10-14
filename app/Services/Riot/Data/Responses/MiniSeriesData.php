<?php

namespace App\Services\Riot\Data\Responses;

use Spatie\LaravelData\Data;

class MiniSeriesData extends Data
{
    public function __construct(
        public readonly int $losses,
        public readonly string $progress,
        public readonly int $target,
        public readonly int $wins
    ) {}
}
