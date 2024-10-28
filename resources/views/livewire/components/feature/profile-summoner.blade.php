<div x-init="$wire.$watch('puuid', () => $wire.reactiveProps())">
    <x-badge-summoner :$imgSrc :level="$summoner->summonerLevel" />
</div>
