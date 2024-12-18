<x-layout>
    <section class="pt-10 space-y-10">


        <x-messages.form_message/>

        <section class="space-y-10">
            @isset($events)
                @if($events->isNotEmpty())
                    <x-section-heading>Events organized by {{ $user_name }}</x-section-heading>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-2">
                        @foreach($events as $event)
                            <x-event-wide-card :event="$event" />
                        @endforeach
                    </div>
                @endif
            @endisset


        </section>

    </section>
</x-layout>
