<x-layout>

    <x-page-heading>Categories</x-page-heading>

    {{-- <section class="text-center pb-6">
        <x-forms.form action="{{ route('search') }}" class="mt-6">
            <x-forms.input name="q" :label="false" placeholder="Search Category..." />
        </x-forms.form>
    </section> --}}

    @foreach($categories as $category)
        <x-category-card :category="$category"/>
    @endforeach
</x-layout>


