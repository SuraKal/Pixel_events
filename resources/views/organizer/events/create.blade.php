<x-layout>
    <x-page-heading>Create your next event</x-page-heading>

    <x-forms.form method="POST" action="{{ route('manage.event.store') }}" enctype="multipart/form-data" >
        
        <x-forms.input label="Name" name="name" />
        <x-forms.input label="Description" name="description"/>
        <x-forms.input label="Date" name="date" type="date"/>
        <x-forms.input label="Location" name="location" />

        <x-forms.divider/>

        {{-- <x-forms.checkbox label="Role" name="role" discribe="Check if you are an organizer" /> --}}

        <x-forms.select label="Category" name="category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" class="text-gray-500">{{ $category->name }}</option>
            @endforeach
        </x-forms.select>

        <x-forms.input label="Event Cover" name="image" type="file" />

        <x-forms.button>Submit</x-forms.button>
    </x-forms.form>
</x-layout>