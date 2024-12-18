<x-layout>
    <section class="pt-10 space-y-10">
        @isset($events)
            @if($events->isNotEmpty())
                <x-section-heading>Events</x-section-heading>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-2">
                    @foreach($events as $event)
                        <x-event-wide-card :event="$event" />
                    @endforeach
                </div>
            @endif
        @endisset
        @isset($cancelled_events)
            @if($cancelled_events->isNotEmpty())
                <x-section-heading>Cancelled Events</x-section-heading>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-2">
                    @foreach($cancelled_events as $event)
                        <x-event-wide-card :event="$event" />
                    @endforeach
                </div>
            @endif
        @endisset
    </section>
</x-layout>
