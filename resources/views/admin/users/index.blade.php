<x-layout>
    <x-page-heading>Users' List</x-page-heading>
    <x-messages.form_message/>
    <!-- Create User Button -->
    <div class="flex justify-end mb-10">
        <x-forms.link-button href="{{ route('admin.user.create') }}" >
            + Create User
        </x-forms.link-button>
        {{-- <a href="{{ route('admin.user.create') }}" 
            class=" text-white text-sm font-semibold py-3 px-6 rounded shadow-lg transition-transform duration-200 hover:-translate-y-1 ml-auto">
            
        </a> --}}
    </div>

    @foreach($users as $user)
        <x-panel class="flex flex-col text-start mb-5 bg-gray-800 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <!-- User Info and Actions -->
            <div class="flex justify-between items-center mb-4">
                <!-- User Info -->
                <div>
                    <h3 class="text-2xl font-bold mb-1 text-blue-400 hover:text-blue-500 transition-colors duration-300">
                        {{ $user->name }}
                    </h3>
                    <p class="text-sm text-gray-400">{{ $user->email }}</p>
                </div>

                <!-- Action Buttons -->
                <div class="space-x-2">
                <x-forms.link-button href="{{ route('admin.user.events.attended', $user) }}">
                    Show Events Attended
                </x-forms.link-button>

                @if($user->hasRole('organizer'))
                    <x-forms.link-button href="{{ route('admin.user.events.organized', $user) }}">
                        Show Events Organized
                    </x-forms.link-button>
                @endif
                    {{-- <a href="{{ route('admin.user.events.attended', $user) }}" class=" text-white text-sm font-semibold  py-2 px-3  rounded shadow-lg transition-transform duration-200 hover:-translate-y-1">
                        Show Events Attended
                    </a>
                    <a href="{{ route('admin.user.events.organized', $user) }}" class="text-white text-sm font-semibold  py-2 px-3  rounded shadow-lg transition-transform duration-200 hover:-translate-y-1">
                        Show Events Organized
                    </a> --}}
                </div>
            </div>

            <!-- Role and Event Count -->
            <div class="flex justify-between items-center border-t border-gray-700 pt-4">
                <div>
                    <p class="text-sm font-semibold text-gray-300">
                        Role: 
                        @foreach ($user->roles as $role)
                            <span class="text-green-400 text-sm"> {{ Str::title($role->name) }}@if(!$loop->last),@endif </span>
                        @endforeach
                    </p>
                </div>
                <p class="text-sm font-semibold">
                    Attended <span class="text-blue-400">{{ $user->registered_attended_events_count }}</span> events
                </p>
            </div>

            <!-- Edit and Delete Buttons -->
            <div class="flex justify-end space-x-4 mt-4">
                <x-forms.link-button href="{{ route('admin.user.edit', $user) }}">
                    Edit
                </x-forms.link-button>
                <form action="{{ route('admin.user.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                        class="bg-red-500 hover:bg-red-600 text-white text-sm font-semibold py-2 px-3 rounded shadow-lg transition-transform duration-200 hover:-translate-y-1">
                        Delete
                    </button>
                </form>
            </div>
        </x-panel>
    @endforeach
</x-layout>
