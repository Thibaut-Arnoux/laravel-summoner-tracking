<?php

namespace App\Services\Riot;

use App\Services\Riot\Data\Account\AccountData;
use App\Services\Riot\Requests\Account\GetAccountRequest;

class RiotService
{
    public function accountByPuuid(string $puuid): AccountData
    {
        $data = GetAccountRequest::build()
            ->withPuuid($puuid)
            ->send()
            ->throw()
            ->json();

        return AccountData::from($data);
    }

    public function accountByNameAndTag(string $gameName, string $tagLine): AccountData
    {
        $data = GetAccountRequest::build()
            ->withNameAndTag($gameName, $tagLine)
            ->send()
            ->throw()
            ->json();

        return AccountData::from($data);
    }
}
