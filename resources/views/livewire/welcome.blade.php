<div>
    <!-- HEADER -->
    <x-header title="Profile" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <div class="inline-flex gap-2">
                <x-select icon="o-map" :options="$regions" wire:model.live="regionTag" />
                <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
            </div>
        </x-slot:middle>
    </x-header>
</div>
