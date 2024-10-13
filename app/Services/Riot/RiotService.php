<?php

namespace App\Services\Riot;

use App\Services\Riot\Data\AccountData;
use App\Services\Riot\Data\SummonerData;
use App\Services\Riot\Enums\RegionTagEnum;
use App\Services\Riot\Requests\Account\GetAccountRequest;
use App\Services\Riot\Requests\Summoner\GetSummonerRequest;

class RiotService
{
    public function accountByPuuid(string $puuid): AccountData
    {
        return AccountData::from(GetAccountRequest::build()
            ->withPuuid($puuid)
            ->send()
            ->throw()
            ->json()
        );
    }

    public function accountByNameAndTag(string $gameName, string $tagLine): AccountData
    {
        return AccountData::from(GetAccountRequest::build()
            ->withNameAndTag($gameName, $tagLine)
            ->send()
            ->throw()
            ->json()
        );
    }

    public function summonerByPuuid(RegionTagEnum $regionTag, string $puuid): SummonerData
    {
        return SummonerData::from(GetSummonerRequest::build(...['regionTag' => $regionTag])
            ->withPuuid($puuid)
            ->send()
            ->throw()
            ->json()
        );
    }

    public function summonerByAccountId(RegionTagEnum $regionTag, string $accountId): SummonerData
    {
        return SummonerData::from(GetSummonerRequest::build(...['regionTag' => $regionTag])
            ->withAccountId($accountId)
            ->send()
            ->throw()
            ->json()
        );
    }

    public function summonerById(RegionTagEnum $regionTag, string $summonerId): SummonerData
    {
        return SummonerData::from(GetSummonerRequest::build(...['regionTag' => $regionTag])
            ->withId($summonerId)
            ->send()
            ->throw()
            ->json()
        );
    }
}
