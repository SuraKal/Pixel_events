<x-layout>
    <section class="pt-10 space-y-10">

        <div class="flex">
            <x-forms.link-button class="bg-blue-800 rounded py-2 px-6 font-bold ml-auto" href="{{ route('manage.event.create') }}">
                Create New
            </x-forms.link-button>
        </div>
        

        <x-messages.form_message/>

        <section class="space-y-10">
            @isset($events)
                @if($events->isNotEmpty())
                    <x-section-heading>Your Created Events</x-section-heading>
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
