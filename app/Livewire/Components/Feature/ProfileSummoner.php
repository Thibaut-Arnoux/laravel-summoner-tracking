<?php

namespace App\Livewire\Components\Feature;

use App\Services\Riot\Data\Responses\SummonerData;
use App\Services\Riot\Enums\RegionTagEnum;
use App\Services\Riot\RiotService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class ProfileSummoner extends Component
{
    #[Reactive]
    public string $puuid;

    #[Reactive]
    public RegionTagEnum $regionTag;

    public SummonerData $summoner;

    public function mount(string $puuid, RegionTagEnum $regionTag, RiotService $riot): void
    {
        $this->puuid = $puuid;
        $this->regionTag = $regionTag;
        $this->summoner = $riot->summonerByPuuid(regionTag: $this->regionTag, puuid: $this->puuid);
    }

    public function reactiveProps(RiotService $riot): void
    {
        $this->summoner = $riot->summonerByPuuid(regionTag: $this->regionTag, puuid: $this->puuid);
    }

    public function render(): View
    {
        return view('livewire.components.feature.profile-summoner', [
            'imgSrc' => config('services.riot.ddragon_uri')."/img/profileicon/{$this->summoner->profileIconId}.png",
        ]);
    }
}
