<div>
    <x-header title="Profile" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <livewire:components.forms.search-summoner />
        </x-slot:middle>
    </x-header>

    @if ($account)
        <livewire:components.feature.profile-summoner :puuid="$account->puuid" :$regionTag />
    @endif
</div>
