@props(['imgSrc', 'level'])

<div class="relative w-32 h-32">
    <img src={{ $imgSrc }} alt="Icon" class="rounded-xl border-2 border-primary">
    <div
        class="absolute bottom-0 left-1/2 -translate-x-1/2 translate-y-1/2 bg-gray-700 text-white rounded-xl px-3 py-1 text-xs font-bold ">
        {{ $level }}
    </div>
</div>
