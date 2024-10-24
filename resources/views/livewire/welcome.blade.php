<div>
    <!-- HEADER -->
    <x-header title="Profile" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <div class="inline-flex gap-2">
                <x-select icon="o-map" :options="$regions" wire:model.live="regionTag" />
                <x-input placeholder="Search..." wire:model.live.debounce="summonerName" clearable
                    icon="o-magnifying-glass" />
                <x-tags class="w-1" wire:model.live="summonerTag" />
            </div>
        </x-slot:middle>
    </x-header>
</div>
