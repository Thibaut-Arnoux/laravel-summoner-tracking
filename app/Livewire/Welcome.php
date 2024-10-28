<?php

namespace App\Livewire;

use App\Services\Riot\Data\Responses\AccountData;
use App\Services\Riot\Enums\RegionTagEnum;
use App\Services\Riot\RiotService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Welcome extends Component
{
    public RegionTagEnum $regionTag;

    public AccountData $account;

    /**
     * @param  array{regionTag: string, summonerName: string, summonerTag: string}  $search
     */
    #[On('search-summoner')]
    public function searchSummoner(array $search, RiotService $riotService): void
    {
        ['regionTag' => $regionTag, 'summonerName' => $name, 'summonerTag' => $tag] = $search;

        $this->account = $riotService->accountByNameAndTag(gameName: $name, tagLine: $tag);
        $this->regionTag = RegionTagEnum::from($regionTag);
    }

    public function render(): View
    {
        return view('livewire.welcome');
    }
}
