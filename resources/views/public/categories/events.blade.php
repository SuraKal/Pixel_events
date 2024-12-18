<x-layout>
    <section class="pt-10">
        <x-page-heading>Events under {{ $category->name }}</x-page-heading>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-6">
            @foreach($events as $event)
                <x-event-wide-card :event="$event"/>
            @endforeach
        </div>
    </section>
</x-layout>
