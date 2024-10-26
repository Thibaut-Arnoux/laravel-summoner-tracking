<div>
    <!-- HEADER -->
    <x-header title="Profile" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <form wire:submit="searchSummoner">
                <div class="flex flex-col sm:flex-row gap-2">
                    <x-select icon="o-map" :options="$regions" wire:model.live="form.regionTag" />
                    <x-input placeholder="Search..." wire:model="form.summonerName" clearable>
                        <x-slot:append>
                            <div class="w-32">
                                <x-input wire:model="form.summonerTag" class="rounded-s-none" clearable>
                                    <x-slot:prepend>
                                        <div
                                            class="h-full rounded-s-none flex items-center bg-base-200 border border-primary border-s-0 border-e-0 px-2">
                                            #
                                        </div>
                                    </x-slot:prepend>
                                </x-input>
                            </div>
                        </x-slot:append>
                    </x-input>
                    <div class="flex justify-end">
                        <x-button type="submit" icon="o-magnifying-glass" class="btn-primary btn-square btn-outline" />
                    </div>
                </div>
            </form>
        </x-slot:middle>
    </x-header>
</div>
