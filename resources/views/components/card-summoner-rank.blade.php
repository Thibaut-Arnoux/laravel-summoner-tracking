@use('Illuminate\Support\Number')
@props(['queueType', 'cardImgSrc', 'tier', 'rank', 'wins', 'losses', 'lp'])

<div class="w-full min-w-80 rounded-lg shadow-lg border border-primary overflow-hidden">
    <div class="text-sm font-semibold px-4 py-2">
        {{ $queueType }}
    </div>
    <hr />
    <div class="flex flex-row justify-between p-4 gap-4 bg-base-100">
        <div class="w-24 rounded-full border border-primary bg-base-200 overflow-hidden">
            <img class="object-cover w-full h-full p-2" src={{ $cardImgSrc }} alt="Rank Icon">
        </div>
        <div class="flex flex-wrap">
            <div class="flex justify-between items-center w-full">
                <div class="text-xl font-bold">{{ $tier }} {{ $rank }}</div>
                <div class="text-sm">{{ $wins }}V {{ $losses }}D</div>
            </div>

            <div class="flex justify-between w-full items-center">
                <div class="text-sm">{{ $lp }} LP</div>
                <div class="text-sm">Winrate {{ Number::percentage(($wins / ($wins + $losses)) * 100) }}</div>
            </div>
        </div>
    </div>
</div>
