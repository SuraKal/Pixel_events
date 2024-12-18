@props(['type'])

@if($type == 'success')
    <x-badge color="blue" class="text-xl">
        {{ session('success') }}
    </x-badge>

@elseif($type == 'error')
    <x-badge color="red" class="text-xl">
        {{ session('error') }}
    </x-badge>
@elseif($type == 'info')
    <x-badge color="blue" class="text-xl">
        {{ session('info') }}
    </x-badge>
@endif

{{-- <span class="badge badge-danger">Cancelled</span> --}}