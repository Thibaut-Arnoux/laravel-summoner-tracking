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
     * @var Collection<int, LeagueEntryData>
     */
    public Collection $leagues;

    public function mount(string $puuid, RegionTagEnum $regionTag, RiotService $riot): void
    {
        $this->puuid = $puuid;
        $this->regionTag = $regionTag;
        $this->summoner = $riot->summonerByPuuid(regionTag: $this->regionTag, puuid: $this->puuid);
        $this->leagues = $riot->leagueBySummonerId(regionTag: $this->regionTag, summonerId: $this->summoner->id)
            ->filter(fn (LeagueEntryData $league) => in_array($league->queueType, [QueueEnum::RANKED_SOLO_5x5, QueueEnum::RANKED_FLEX_SR]))
            ->sortBy(fn (LeagueEntryData $league) => $league->queueType === QueueEnum::RANKED_SOLO_5x5 ? 0 : 1);
    }

    public function reactiveProps(RiotService $riot): void
    {
        $this->summoner = $riot->summonerByPuuid(regionTag: $this->regionTag, puuid: $this->puuid);
        $this->leagues = $riot->leagueBySummonerId(regionTag: $this->regionTag, summonerId: $this->summoner->id)
            ->filter(fn (LeagueEntryData $league) => in_array($league->queueType, [QueueEnum::RANKED_SOLO_5x5, QueueEnum::RANKED_FLEX_SR]))
            ->sortBy(fn (LeagueEntryData $league) => $league->queueType === QueueEnum::RANKED_SOLO_5x5 ? 0 : 1);
    }

    public function render(): View
    {
        return view('livewire.components.feature.profile-summoner', [
            'badgeImgSrc' => config('services.riot.ddragon_uri')."/img/profileicon/{$this->summoner->profileIconId}.png",
            'leagueDatas' => $this->leagues->map(function (LeagueEntryData $league) {
                return [
                    'queueType' => $league->queueType,
                    'cardImgSrc' => Vite::asset("resources/images/tier/" . Str::lower($league->tier->value) . ".png"),
                    'tier' => $league->tier->value,
                    'rank' => $league->rank->value,
                    'wins' => $league->wins,
                    'losses' => $league->losses,
                    'lp' => $league->leaguePoints,
                ];
            })
        ]);
    }
}
