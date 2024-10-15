<?php

namespace App\Services\Riot\Requests\League;

use App\Services\Riot\Enums\LeagueTierEnum;
use App\Services\Riot\Enums\QueueEnum;
use App\Services\Riot\Requests\RiotRegionTagRequest;

class GetLeagueTierRequest extends RiotRegionTagRequest
{
    protected string $method = 'GET';

    protected string $path = '/lol/league/v4/%s/by-queue';

    public function withQueue(LeagueTierEnum $leagueTier, QueueEnum $queue): self
    {
        return $this->setPath(sprintf($this->path, $leagueTier->value))
            ->appendPath($queue->value);
    }
}
