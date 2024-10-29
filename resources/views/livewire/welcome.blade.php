<div>
    <x-header title="Profile" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <livewire:components.forms.search-summoner />
        </x-slot:middle>
    </x-header>

    @if ($account)
        <livewire:components.feature.profile-summoner :puuid="$account->puuid" :$regionTag />

        <div class="mt-4 w-80">
            <x-card-summoner-rank queueType="Ranked Solo 5x5" :imgSrc="Vite::asset('resources/images/tier/gold.png')" tier="Gold" rank="4" wins="14"
                losses="9" lp="95" />
        </div>
    @endif
</div>
