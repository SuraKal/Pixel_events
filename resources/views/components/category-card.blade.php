@props(['category'])

<x-panel class="flex flex-col text-start mb-5">
    
    <div class="py-2">
        <div class="flex justify-between">
            <div class="self-start">
                <a href="{{ route('category.events', $category) }}">
                    <h3 class="group-hover:text-blue-800 text-xl font-bold transition-colors duration-300">{{$category->name}}
                    </h3>
                </a>
            </div>
            <div class="self-end text-sm">
                {{-- <a href="">Show Events</a> --}}
                <p class="text-green-500 text-xs">({{ $category->events_count }} Event Posted)</p>

                {{-- <i class="fa-regular fa-bookmark"></i> --}}
            </div>
        </div>

    </div>

    <div class="flex justify-between items-center mt-auto">
        <!-- Tags -->
        <div class="ml-auto">
            {{-- <x-forms.link-button href="{{ route('category.events', $category) }}" >Show Events</x-forms.link-button> --}}

            <a 
            class="text-sm/6 font-semibold text-white-900 px-2"
            href="{{ route('category.events', $category) }}">
                Show Events
            <span aria-hidden="true"></span></a>
            {{-- <x-tag size="small" :category="$event->category"/> --}}
        </div>
    </div>
</x-panel>
