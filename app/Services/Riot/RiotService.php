<?php

namespace App\Services\Riot;

use App\Services\Riot\Data\Responses\AccountData;
use App\Services\Riot\Data\Responses\LeagueData;
use App\Services\Riot\Data\Responses\LeagueEntryData;
use App\Services\Riot\Data\Responses\SummonerData;
use App\Services\Riot\Enums\LeagueEnum;
use App\Services\Riot\Enums\QueueEnum;
use App\Services\Riot\Enums\RankEnum;
use App\Services\Riot\Enums\RegionTagEnum;
use App\Services\Riot\Enums\TierEnum;
use App\Services\Riot\Requests\Account\GetAccountRequest;
use App\Services\Riot\Requests\League\GetLeagueEntryRequest;
use App\Services\Riot\Requests\League\GetLeagueRequest;
use App\Services\Riot\Requests\Summoner\GetSummonerRequest;
use Illuminate\Support\Collection;

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

    /**
     * @return Collection<int, LeagueEntryData>
     */
    public function leagueBySummoner(RegionTagEnum $regionTag, string $summonerId): Collection
    {
        return LeagueEntryData::collect(
            items: GetLeagueEntryRequest::build(...['regionTag' => $regionTag])
                ->withSummonerId($summonerId)
                ->send()
                ->throw()
                ->json(),
            into: Collection::class
        );
    }

    /**
     * @return Collection<int, LeagueEntryData>
     */
    public function leagueByQueueTierRank(RegionTagEnum $regionTag, QueueEnum $queueType, TierEnum $tier, RankEnum $rank, int $page = 1): Collection
    {
        return LeagueEntryData::collect(
            items: GetLeagueEntryRequest::build(...['regionTag' => $regionTag])
                ->withQueueTierRank($queueType, $tier, $rank)
                ->withQuery(['page' => $page])
                ->send()
                ->throw()
                ->json(),
            into: Collection::class
        );
    }

    public function leagueByQueueName(RegionTagEnum $regionTag, LeagueEnum $league, QueueEnum $queueType): LeagueData
    {
        return LeagueData::from(GetLeagueRequest::build(...['regionTag' => $regionTag])
            ->withQueue($league, $queueType)
            ->send()
            ->throw()
            ->json()
        );
    }
}
