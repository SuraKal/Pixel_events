<x-layout>
        <div class="relative isolate px-6  lg:px-8">
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
            <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
                <div class="text-center">
                    <h1 class="text-balance text-5xl font-semibold tracking-tight text-white-900 sm:text-7xl">Pixler
                        Event</h1>



                    <section class="text-center pt-6">
                        <h1 class="font-bold text-2xl">Let's Find Your Event</h1>
                        <x-forms.form action="{{ route('search') }}" class="mt-6">
                            <x-forms.input name="q" :label="false" placeholder="Dev Fest 2024..." />
                        </x-forms.form>
                    </section>
                </div>
            </div>
            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                aria-hidden="true">
                <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
        </div>

        {{-- Featured Events --}}
        @isset($featured_events)
            @if($featured_events->isNotEmpty())
                <section class="pt-10">
                    <x-section-heading>Featured Events</x-section-heading>
                    <div class="grid lg:grid-cols-3 gap-8 mt-6">
                        @foreach($featured_events as $event)
                            <x-event-card :event="$event" />
                        @endforeach
                    </div>
                </section>
            @endif
        @endisset


        @isset($events)
            @if($events->isNotEmpty())
                <section class="pt-10">
                    <x-section-heading>Recent Events</x-section-heading>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-6">
                        @foreach($events as $event)
                            <x-event-wide-card :event="$event"/>
                        @endforeach
                    </div>
                </section>
            @endif
        @endisset

</x-layout>
