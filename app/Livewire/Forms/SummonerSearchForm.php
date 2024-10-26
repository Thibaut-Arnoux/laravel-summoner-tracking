<?php

namespace App\Livewire\Forms;

use App\Services\Riot\Enums\RegionTagEnum;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SummonerSearchForm extends Form
{
    #[Validate('required')]
    public RegionTagEnum $regionTag = RegionTagEnum::EUW;

    #[Validate('required')]
    public string $summonerName = '';

    #[Validate('required|min:3|uppercase')]
    public string $summonerTag = '';
}
