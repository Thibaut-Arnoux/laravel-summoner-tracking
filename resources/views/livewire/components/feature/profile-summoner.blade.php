<div x-init="$wire.$watch('puuid', () => $wire.reactiveProps())">
    <x-badge-summoner :$badgeImgSrc :level="$summoner->summonerLevel" />
    @foreach ($leagues as $queueType => $league)
        <div class="mt-4 w-80">
            @if ($league)
                <x-card-summoner-rank :queueType="$league['queueType']" :cardImgSrc="$league['cardImgSrc']" :tier="$league['tier']" :rank="$league['rank']"
                    :wins="$league['wins']" :losses="$league['losses']" :lp="$league['lp']" />
            @else
                <x-card-summoner-unranked :queueType="$queueType" />
            @endif
        </div>
    @endforeach
</div>
