<x-layout>
    <x-page-heading>Customise {{ $user->name }} Profile</x-page-heading>

    <x-forms.form method="POST" action="{{ route('admin.user.update', $user) }}" enctype="multipart/form-data" >

        <x-forms.input label="Name" name="name" value="{{ $user->name }}"/>
        <x-forms.input label="Email" name="email" type="email" value="{{ $user->email }}"/>

        <x-forms.divider/>

        {{-- <x-forms.checkbox label="Role" name="role" discribe="Check if you are an organizer" /> --}}

        {{-- <x-forms.select label="Role" name="role">
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ Str::title($role->name )}}</option>

                @if($role->id == $user->role_id)
                    <option value="{{ $role->id }}" class="text-gray-500" selected>{{ $role->name }}</option>
                @else
                    <option value="{{ $role->id }}" class="text-gray-500">{{ $role->name }}</option>
                @endif
            @endforeach

            
        </x-forms.select> --}}

        {{-- <x-forms.input label="Profile" name="profile" type="file" /> --}}

        <x-forms.button>Submit</x-forms.button>
    </x-forms.form>
</x-layout>