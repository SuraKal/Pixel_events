@props(['event'])

<a href="{{ route('event.show', $event) }}" class="block">
    <ul role="list" class="divide-y divide-gray-100">
        <x-panel class="flex flex-col text-start">
            <li class="flex justify-between gap-x-1 py-1">
                <div class="flex min-w-0 gap-x-4">
                    <div class="min-w-0 flex-auto">
                        <p class="text-md/6 font-semibold text-white-900">{{ $event->name }}</p>
                        <p class="mt-1 truncate text-sm/5 text-gray-400">{{ $event->location }}</p>

                        @can('is_organizer_or_admin', $event)
                            <p class="mt-4 text-xs/5 text-white-500">{{ $event->registered_count }} people registered</p>
                        @endcan
                    </div>
                </div>
                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                    <p class="text-sm/6 text-white-900 rounded border py-1 px-2 border-white/10">
                        @can('is_organizer', $event)
                            {{-- <a href="{{ route('manage.event.edit', $event) }}" class="text-white-900 hover:underline">
                                
                            </a> --}}
                            <button form="edit-event-{{ $event->id }}" type="submit">
                                <i class="fa-regular fa-edit pr-2"></i>
                            </button>
                            <button form="delete-event-{{ $event->id }}" type="submit">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        @else
                            <i class="fa-regular fa-bookmark"></i>
                        @endcan
                    </p>
                    {{-- registered_count --}}
                    
                    <p class="mt-1 text-xs/5 text-white-500">{{ $event->date }}</p>
                    <p class="mt-1 text-xs/5 text-white-500">{{ $event->status }}</p>
                </div>
            </li>
        </x-panel>
    </ul>
</a>


@can('is_organizer', $event)
    <form method="GET" id="edit-event-{{ $event->id }}" class="hidden" action="{{ route('manage.event.edit', $event) }}">
        @csrf
    </form>
    <form method="POST" id="delete-event-{{ $event->id }}" class="hidden" action="{{ route('manage.event.delete', $event) }}">
        @csrf
        @method('DELETE')
    </form>
@endcan
