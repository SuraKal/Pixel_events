<x-layout>
    <x-page-heading>Register</x-page-heading>

    <x-forms.form method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data" >

        <x-forms.input label="Name" name="name" />
        <x-forms.input label="Email" name="email" type="email"/>
        <x-forms.input label="Password" name="password" type="password"/>
        <x-forms.input label="Password Confirmation" name="password_confirmation" type="password"/>

        <x-forms.divider/>

        {{-- <x-forms.checkbox label="Role" name="role" discribe="Check if you are an organizer" /> --}}

        <x-forms.select label="Role" name="role">
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ Str::title($role->name )}}</option>
            @endforeach
        </x-forms.select>

        <x-forms.input label="Profile" name="profile" type="file" />

        <x-forms.button>Submit</x-forms.button>
    </x-forms.form>
</x-layout>