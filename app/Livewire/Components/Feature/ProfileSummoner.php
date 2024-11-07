<?php

namespace App\Livewire\Components\Feature;

use App\Services\Riot\Data\Responses\LeagueEntryData;
use App\Services\Riot\Data\Responses\SummonerData;
use App\Services\Riot\Enums\QueueEnum;
use App\Services\Riot\Enums\RegionTagEnum;
use App\Services\Riot\RiotService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Str;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class ProfileSummoner extends Component
{
    #[Reactive]
    public string $puuid;

    #[Reactive]
    public RegionTagEnum $regionTag;

    public SummonerData $summoner;

    /**
     * @var Collection<string, LeagueEntryData|null>
     */
    public Collection $leagueDatas;

    public function mount(string $puuid, RegionTagEnum $regionTag, RiotService $riot): void
    {
        $this->puuid = $puuid;
        $this->regionTag = $regionTag;
        $this->reactiveProps($riot);
    }

    public function reactiveProps(RiotService $riot): void
    {
        $this->summoner = $riot->summonerByPuuid(regionTag: $this->regionTag, puuid: $this->puuid);
        $leaguesInfo = $riot->leagueBySummonerId(regionTag: $this->regionTag, summonerId: $this->summoner->id);
        $this->leagueDatas = collect([
            QueueEnum::RANKED_SOLO_5x5->value => $leaguesInfo->where('queueType', QueueEnum::RANKED_SOLO_5x5)->first(),
            QueueEnum::RANKED_FLEX_SR->value => $leaguesInfo->where('queueType', QueueEnum::RANKED_FLEX_SR)->first(),
        ]);
    }

    public function render(): View
    {
        return view('livewire.components.feature.profile-summoner', [
            'badgeImgSrc' => config('services.riot.ddragon_uri')."/img/profileicon/{$this->summoner->profileIconId}.png",
            'leagues' => $this->leagueDatas->map(function (?LeagueEntryData $leagueData, string $queueType) {
                return $leagueData ? [
                    'queueType' => $queueType,
                    'cardImgSrc' => Vite::asset('resources/images/tier/'.Str::lower($leagueData->tier->value).'.png'),
                    'tier' => $leagueData->tier->value,
                    'rank' => $leagueData->rank->value,
                    'wins' => $leagueData->wins,
                    'losses' => $leagueData->losses,
                    'lp' => $leagueData->leaguePoints,
                ] : [];
            }),
        ]);
    }
}
