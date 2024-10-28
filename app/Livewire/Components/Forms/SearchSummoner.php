<?php

namespace App\Livewire\Components\Forms;

use App\Livewire\Forms\SearchSummonerForm;
use App\Services\Riot\Enums\RegionTagEnum;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class SearchSummoner extends Component
{
    /**
     * @var Collection<int, array{id: string, name: string}>
     */
    public Collection $regions;

    public SearchSummonerForm $form;

    public function searchSummoner(): void
    {
        $this->form->validate();
        $this->dispatch('search-summoner', search: $this->form->all());

        $this->form->reset();
        $this->form->summonerTag = $this->form->regionTag->getSummonerTag();
    }

    public function mount(): void
    {
        $this->form->summonerTag = $this->form->regionTag->getSummonerTag();

        $this->regions = collect(RegionTagEnum::cases())
            ->map(fn (RegionTagEnum $regionTag) => [
                'id' => $regionTag->value,
                'name' => $regionTag->getRegionName(),
            ])
            ->sortBy('name');
    }

    public function updatedFormRegionTag(): void
    {
        $this->form->summonerTag = $this->form->regionTag->getSummonerTag();
    }

    public function render(): View
    {
        return view('livewire.components.forms.search-summoner');
    }
}
