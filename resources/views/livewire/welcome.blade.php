<div>
    <x-header title="Profile" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <livewire:components.forms.search-summoner />
        </x-slot:middle>
    </x-header>

    @if ($account)
        <livewire:components.feature.profile-summoner :puuid="$account->puuid" :$regionTag />

        <div class="m-4"></div>

        {{-- TODO : Move to component --}}
        <div class="w-80 rounded-lg shadow-lg border border-primary overflow-hidden">
            <div class="text-sm font-semibold px-4 py-2">
                Classé en solo/duo
            </div>
            <hr />
            <div class="flex flex-row p-4 gap-4 bg-base-100">
                <img src="https://placehold.co/64" alt="Rank Icon" class="w-24 h-24 rounded-full">
                <div class="w-full flex flex-wrap ">
                    <div class="flex justify-between items-center w-full">
                        <div class="text-xl font-bold">Gold 4</div>
                        <div class="text-sm">14V 9D</div>
                    </div>

                    <div class="flex justify-between w-full items-center">
                        <div class="text-sm">95 LP</div>
                        <div class="text-sm">Taux de Victoire 61%</div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
