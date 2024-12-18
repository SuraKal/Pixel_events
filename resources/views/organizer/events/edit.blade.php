<x-layout>
    <x-page-heading>{{ $event->name }} Information</x-page-heading>

    

    <x-forms.form method="POST" action="{{ route('manage.event.update', $event) }}" enctype="multipart/form-data" >

        <x-forms.input label="Name" name="name" value="{{ $event->name }}"/>
        <x-forms.input label="Description" name="description" value="{{ $event->description }}"/>
        <x-forms.input label="Date" name="date" type="date" value="{{ $event->date }}"/>
        <x-forms.input label="Location" name="location"  value="{{ $event->location }}"/>

        <x-forms.divider/>

        {{-- <x-forms.checkbox label="Role" name="role" discribe="Check if you are an organizer" /> --}}

        <x-forms.select label="Category" name="category_id">
            @foreach($categories as $category)
                @if($category->id == $event->category_id)
                    <option value="{{ $category->id }}" class="text-gray-500" selected>{{ $category->name }}</option>
                @else
                    <option value="{{ $category->id }}" class="text-gray-500">{{ $category->name }}</option>
                @endif
            @endforeach
        </x-forms.select>

        {{-- <x-forms.input label="Event Cover" name="image" type="file" /> --}}

        <x-forms.button>Update</x-forms.button>
    </x-forms.form>

    {{-- <x-forms.divider />

    <x-page-heading>Change Password</x-page-heading>


    <x-forms.form method="POST" action="{{ route('password.update') }}" enctype="multipart/form-data" >

        <x-forms.input label="Custom Password" name="current_password" type="password" required/>
        <x-forms.input label="Password" name="password" type="password" required/>
        <x-forms.input label="Password Confirmation" name="password_confirmation" type="password" required/>

        <x-forms.button>Update Password</x-forms.button>
    </x-forms.form> --}}
</x-layout>