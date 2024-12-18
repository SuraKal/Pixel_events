<x-layout>
    <x-section-heading>
        Event Information
    </x-section-heading>
    {{-- event --}}

    <x-panel class="flex flex-col text-start mt-5">
        <x-messages.form_message />

        <div class="py-2">
            <div class="flex justify-between">
                <div class="self-start">
                    <h3 class="group-hover:text-blue-800 text-xl font-bold transition-colors duration-300">
                        Event Name : {{ $event->name }}
                    </h3>
                </div>

                <div class="self-end text-sm">


                    {{-- Own = False, Others = True --}}



                    @auth
                        @if (auth()->user()->can('is_organizer', $event) || auth()->user()->hasRole('admin'))
                            <x-forms.button form="attendee_event">View Attendee</x-forms.button>
                            @if(auth()->user()->hasRole('admin') && ($event->status == 'pending' || $event->status == 'cancelled'))
                                <x-forms.button form="approve_event">Approve Event</x-forms.button>
                            @endif
                            @if(auth()->user()->can('is_organizer', $event))
                                <x-forms.button form="edit-event-{{ $event->id }}">Edit</x-forms.button>
                                <x-forms.button form="delete-event-{{ $event->id }}">Remove</x-forms.button>
                            @endif
                        @else
                            {{-- @if($event->status == 'approved' ) --}}
                            @can('is_event_approved',$event)
                                @if (auth()->user()->can('attend', $event))
                                    <x-forms.button form="attend_event">Attend Event</x-forms.button>
                                @elseif (auth()->user()->can('re_register', $event))
                                    <x-badge color="red">Cancelled Event</x-badge>
                                    <x-forms.button form="re_register">Remove Cancellation</x-forms.button>
                                @else
                                    <x-badge color="blue">Registered Event</x-badge>
                                    <x-forms.button form="cancel_event">Cancel Registration</x-forms.button>
                                @endif
                            @endcan
                        @endif
                    @endauth

                    @guest
                        <x-forms.button form="attend_event">Attend Event</x-forms.button>
                    @endguest

                </div>
            </div>

            {{-- To register for event --}}
            <form action="{{ route('event.attend', $event) }}" method="POST" id="attend_event" class="hidden">
                @csrf
            </form>
            {{-- To cancel an event  --}}
            <form action="{{ route('event.cancel_event', $event) }}" method="POST" id="cancel_event" class="hidden">
                @csrf
            </form>

            {{-- To remove cancellation of event  --}}
            <form action="{{ route('event.re_register', $event) }}" method="POST" id="re_register" class="hidden">
                @csrf
            </form>

            {{-- To view attendees of event  --}}
            <form action="{{ route('manage.event.attendee', $event) }}" method="POST" id="attendee_event"
                class="hidden">
                @csrf
            </form>

            @can('is_organizer', $event)
            <form method="GET" id="edit-event-{{ $event->id }}" class="hidden"
                action="{{ route('manage.event.edit', $event) }}">
                @csrf
            </form>
            <form method="POST" id="delete-event-{{ $event->id }}" class="hidden"
                action="{{ route('manage.event.delete', $event) }}">
                @csrf
                @method('DELETE')
            </form>
            @endcan


            <form action="{{ route('admin.event.approve', $event) }}" method="POST" id="approve_event"
                class="hidden">
                @csrf
            </form>

            


            <p class="text-lg mt-3">Location : {{ $event->location }}</p>
            <p class="text-lg mt-2">Date : {{ $event->date }}</p>
            <p class="text-lg mt-2">Category : {{ $event->category->name }}</p>
            <p class="text-lg mt-2">Description : {{ $event->description }}</p>
            <p class="text-lg mt-2">Organizer : {{ $event->organizer->name }}</p>
            <p class="text-lg mt-2">Posted at : {{ $event->created_at}}</p>

            <p class="text-lg mt-2">Verification : {{ $event->status}}</p>

            {{-- Gallery of Event --}}

            <section>
                <div class="m-6 bg-gray rounded-lg shadow-md">
                    @isset($event->images)
                    @if($event->images->isNotEmpty())
                    <x-section-heading>Gallery from the event</x-section-heading>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 pt-4">
                        {{-- @foreach($event->images as $image)
                                        <div class="overflow-hidden rounded-lg shadow-md hover:shadow-lg">
                                            <img src="{{ Vite::asset($image->image_path) }}"
                        alt="Event Image"
                        class="w-full h-48 object-cover transition-transform duration-300 hover:scale-105">
                    </div>
                    @endforeach --}}
                    @foreach($event->images as $image)
                        <div class="overflow-hidden rounded-lg shadow-md hover:shadow-lg">
                            <img src="{{ $image->image_path ? asset($image->image_path) : asset('images/placeholder.png') }}"
                                alt="{{ $event->name }} Image"
                                class="w-full h-48 object-cover transition-transform duration-300 hover:scale-105">
                        </div>
                    @endforeach

                </div>
                @else
                <p class="text-gray-500 text-center mt-4">No images available for this event.</p>
                @endif
                @endisset
        </div>
        </section>




        </div>

        {{-- <div class="flex justify-between items-center mt-auto">
                <div class="ml-auto">
                    <x-tag size="small" :category="$event->category" />
                </div>
            </div> --}}
    </x-panel>

</x-layout>
