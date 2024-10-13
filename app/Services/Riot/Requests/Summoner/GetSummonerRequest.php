<?php

namespace App\Services\Riot\Requests\Summoner;

use App\Services\Riot\Requests\RiotRegionTagRequest;

class GetSummonerRequest extends RiotRegionTagRequest
{
    protected string $method = 'GET';

    protected string $path = '/lol/summoner/v4/summoners';

    public function withPuuid(string $puuid): self
    {
        return $this->appendPath("by-puuid/{$puuid}");
    }

    public function withAccountId(string $accountId): self
    {
        return $this->appendPath("by-account/{$accountId}");
    }

    public function withId(string $summonerId): self
    {
        return $this->appendPath("{$summonerId}");
    }
}
