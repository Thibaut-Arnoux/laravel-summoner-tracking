<?php

namespace App\Livewire;

use App\Services\Riot\Enums\RegionTagEnum;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Livewire\Component;

class Welcome extends Component
{
    public RegionTagEnum $regionTag;

    /**
     * @var Collection<int, array{id: string, name: string}>
     */
    public Collection $regions;

    public string $summonerName = '';

    /**
     * @var array<int, string>
     */
    public array $summonerTag = [];

    public function regionName(RegionTagEnum $regionTag): string
    {
        return match ($regionTag) {
            RegionTagEnum::BR => 'Brazil',
            RegionTagEnum::EUN => 'Europe East',
            RegionTagEnum::EUW => 'Europe West',
            RegionTagEnum::JP => 'Japan',
            RegionTagEnum::KR => 'Korea',
            RegionTagEnum::LA1 => 'LAN',
            RegionTagEnum::LA2 => 'LAS',
            RegionTagEnum::ME => 'Middle East',
            RegionTagEnum::NA => 'North America',
            RegionTagEnum::OC => 'Oceania',
            RegionTagEnum::PH => 'Philippines',
            RegionTagEnum::RU => 'Russia',
            RegionTagEnum::SG => 'Singapore',
            RegionTagEnum::TH => 'Thailand',
            RegionTagEnum::TR => 'Turkiye',
            RegionTagEnum::TW => 'Taiwan',
            RegionTagEnum::VN => 'Vietnam',
        };
    }

    public function mount(): void
    {
        $this->regionTag = RegionTagEnum::EUW;
        $this->summonerTag = [strtoupper($this->regionTag->value)];
        $this->regions = collect(RegionTagEnum::cases())
            ->map(fn (RegionTagEnum $regionTag) => [
                'id' => $regionTag->value,
                'name' => $this->regionName($regionTag),
            ])
            ->sortBy('name');
    }

    public function updatedRegionTag(): void
    {
        $this->summonerTag = [strtoupper($this->regionTag->value)];
    }

    public function updatedSummonerTag(): void
    {
        $this->summonerTag = Arr::last($this->summonerTag) ? [strtoupper(Arr::last($this->summonerTag))] : [];
    }

    public function render(): View
    {
        return view('livewire.welcome');
    }
}
