<?php

namespace App\Services\Riot\Requests\League;

use App\Services\Riot\Enums\LeagueEnum;
use App\Services\Riot\Enums\QueueEnum;
use App\Services\Riot\Requests\RiotRegionTagRequest;

class GetLeagueRequest extends RiotRegionTagRequest
{
    protected string $method = 'GET';

    protected string $path = '/lol/league/v4/%s/by-queue';

    public function withQueue(LeagueEnum $league, QueueEnum $queue): self
    {
        return $this->setPath(sprintf($this->path, $league->value))
            ->appendPath($queue->value);
    }
}
