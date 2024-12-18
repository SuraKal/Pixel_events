<x-layout>
    <x-page-heading>Profile Information</x-page-heading>

    <div class="flex">
        <div class="ml-auto">
            <label for="">Roles : </label>
            @foreach (Auth::user()->roles as $role)
                {{ Str::title($role->name) }}
            @endforeach
        </div>

    </div>



    <x-forms.form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" >
        

        <x-forms.input label="Name" name="name" value="{{ Auth::user()?->name }}"/>
        <x-forms.input label="Email" name="email" type="email" value="{{ Auth::user()?->email }}"/>


        {{-- <x-forms.checkbox label="Role" name="role" discribe="Check if you are an organizer" /> --}}

        {{-- <x-forms.select label="Role" name="role">
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </x-forms.select> --}}


        {{-- <x-forms.input label="roles" name="roles" value="{{ Auth::user()->roles }}"/> --}}

        <x-forms.button>Update</x-forms.button>
    </x-forms.form>

    <x-forms.divider />

    <x-page-heading>Change Password</x-page-heading>


    <x-forms.form method="POST" action="{{ route('password.update') }}" enctype="multipart/form-data" >

        <x-forms.input label="Custom Password" name="current_password" type="password" required/>
        <x-forms.input label="Password" name="password" type="password" required/>
        <x-forms.input label="Password Confirmation" name="password_confirmation" type="password" required/>

        <x-forms.button>Update Password</x-forms.button>
    </x-forms.form>
</x-layout>