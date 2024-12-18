@props(['event'])

<x-panel class="flex flex-col text-start">



<a href="{{ route('event.show', $event) }}" class="block">
    <div class="py-2">
        <div class="flex justify-between">
            <div class="self-start">
                <h3 class="group-hover:text-blue-800 text-xl font-bold transition-colors duration-300">
                    {{ $event->name }}
                </h3>
            </div>
            <div class="self-end text-sm">
                <i class="fa-regular fa-bookmark"></i>
            </div>
        </div>

        <p class="text-sm mt-3">{{ $event->location }}</p>
        <p class="text-sm mt-2">{{ $event->date }}</p>
    </div>

    <div class="flex justify-between items-center mt-auto">
        <div class="ml-auto">
            <x-tag size="small" :category="$event->category" />
        </div>
    </div>
</a>



</x-panel>
