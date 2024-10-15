<?php

namespace App\Services\Riot\Requests\League;

use App\Services\Riot\Requests\RiotRegionTagRequest;

class GetLeagueRequest extends RiotRegionTagRequest
{
    protected string $method = 'GET';

    protected string $path = '/lol/league/v4/leagues';

    public function withId(string $leagueId): self
    {
        return $this->appendPath("{$leagueId}");
    }
}
