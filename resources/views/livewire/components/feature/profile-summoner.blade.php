<div x-init="$wire.$watch('puuid', () => $wire.reactiveProps())">
    <x-badge-summoner :$badgeImgSrc :level="$summoner->summonerLevel" />
    @foreach ($leagueDatas as $league)
        <div class="mt-4 w-80">
            <x-card-summoner-rank :queueType="$league['queueType']" :cardImgSrc="$league['cardImgSrc']" :tier="$league['tier']" :rank="$league['rank']"
                :wins="$league['wins']" :losses="$league['losses']" :lp="$league['lp']" />
        </div>
    @endforeach
</div>
