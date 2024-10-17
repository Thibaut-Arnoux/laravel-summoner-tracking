<?php

namespace App\Livewire;

use App\Services\Riot\Enums\RegionTagEnum;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class Welcome extends Component
{
    public RegionTagEnum $regionTag = RegionTagEnum::EUW;

    public Collection $regions;

    public string $search = '';

    public function mount(): void
    {
        $this->regions = collect(RegionTagEnum::cases())
            ->map(fn (RegionTagEnum $regionTag) => [
                'id' => $regionTag,
                'name' => $regionTag,
            ]);
    }

    public function render(): View
    {
        return view('livewire.welcome');
    }
}
