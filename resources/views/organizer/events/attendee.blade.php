<x-layout>
    <x-page-heading>Attendees' List</x-page-heading>

    {{-- <section class="text-center pb-6">
        <x-forms.form action="{{ route('search') }}" class="mt-6">
    <x-forms.input name="q" :label="false" placeholder="Search Category..." />
    </x-forms.form>
    </section> --}}

    @foreach($attendees as $attendee)
        <x-panel class="flex flex-col text-start mb-5">
            <div class="py-2">
                <div class="flex justify-between">
                    <div class="self-start">
                        <a href="">
                            <h3 class="group-hover:text-blue-800 text-xl font-bold transition-colors duration-300">
                                {{ $attendee->name }}
                            </h3>
                            <h3 class="group-hover:text-blue-800 text-lg font-bold transition-colors duration-300">
                                {{ $attendee->email }}
                            </h3>
                        </a>
                    </div>
                    <div class="self-end text-sm">
                        {{-- <a href="">Show Events</a> --}}
                        <p class="text-green-500 text-xs">{{ $attendee->pivot->status }}</p>
                        <p class="text-black-500 text-xs">Registered at: {{ $attendee->pivot->created_at }}</p>

                        {{-- <i class="fa-regular fa-bookmark"></i> --}}
                    </div>
                </div>

            </div>

            {{-- <div class="flex justify-between items-center mt-auto">
                <div class="ml-auto">

                    <a class="text-sm/6 font-semibold text-white-900 px-2" href="">
                        Show Events
                        <span aria-hidden="true"></span></a>
                </div>
            </div> --}}
        </x-panel>
    @endforeach
</x-layout>
