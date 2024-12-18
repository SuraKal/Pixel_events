<x-layout>
    <section class="pt-10">
        <x-section-heading>Explore Event</x-section-heading>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-6">
            @isset($events)
                @if($events->isNotEmpty())
                    @foreach($events as $event)
                        <x-event-wide-card :event="$event" />
                    @endforeach
                @endif
            @endisset
        </div>
    </section>
</x-layout>


