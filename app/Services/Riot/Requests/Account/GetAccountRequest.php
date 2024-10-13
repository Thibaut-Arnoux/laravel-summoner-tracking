<?php

namespace App\Services\Riot\Requests\Account;

use App\Services\Riot\Requests\RiotRegionNameRequest;

class GetAccountRequest extends RiotRegionNameRequest
{
    protected string $method = 'GET';

    protected string $path = '/riot/account/v1/accounts';

    public function withPuuid(string $puuid): self
    {
        return $this->appendPath("by-puuid/{$puuid}");
    }

    public function withNameAndTag(string $gameName, string $tagLine): self
    {
        return $this->appendPath("by-riot-id/{$gameName}/{$tagLine}");
    }
}
