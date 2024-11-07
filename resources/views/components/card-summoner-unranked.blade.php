@props(['queueType'])

<div
    class="w-full min-w-80 flex flex-row justify-between rounded-lg shadow-lg border border-primary overflow-hidden text-sm font-semibold px-4 py-2">
    <div>
        {{ $queueType }}
    </div>
    <div>
        Unranked
    </div>
</div>
