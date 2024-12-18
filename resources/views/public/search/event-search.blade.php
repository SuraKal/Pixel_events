<x-layout>

    <section class="text-center pt-6">
        <h1 class="font-bold text-2xl">Search Event By Name</h1>
        <x-forms.form action="{{ route('search') }}" class="mt-6">
            <x-forms.input name="q" :label="false" placeholder="Dev Fest 2024..." />
        </x-forms.form>
    </section>
    <section class="pt-10">


        <x-section-heading>Events matching {{ $searched }}</x-section-heading>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-6">
            @isset($events)
            @if($events->isNotEmpty())
            @foreach($events as $event)
            <x-event-wide-card :event="$event" />
            @endforeach
            @else
            <p>No records found</p>
            @endif
            @endisset
        </div>
    </section>
</x-layout>
