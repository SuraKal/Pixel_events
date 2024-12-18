@if(session('success'))
    <x-messages.message_types type='success'/>
@endif

@if(session('error'))
    <x-messages.message_types type='error'/>
@endif

@if(session('info'))
    <x-messages.message_types type='info'/>
@endif
