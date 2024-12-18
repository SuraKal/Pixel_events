

<?php
    use Illuminate\Support\Facades\Route;

    use App\Http\Controllers\User\{
        ProfileController as UserProfileController,
        EventController as UserEventController,
    };
    use App\Http\Controllers\Auth\{
        PasswordController as AuthPasswordController
    };

    use App\Http\Controllers\Organizer\{
        EventController as OrganizerEventController
    };


    // Route to list the events the user registered too
    Route::get('/events/my', [UserEventController::class, 'index'])
            ->name('events.my');


// Event Actions as an attendee (Only access them if a user is not the events organizer , or is an attendee and also if the event is approved)
Route::middleware(['can:is_not_organizer,event','can:is_event_approved,event'])->group(function () {
    Route::post('/event/{event}/attend', [UserEventController::class, 'attend'])
        ->can('attend', 'event')
        ->name('event.attend');
    Route::post('/event/{event}/re_register', [UserEventController::class, 're_register'])
        ->can('update', 'event')
        ->name('event.re_register');
    Route::post('/event/{event}/cancel', [UserEventController::class, 'cancel_event'])
        ->can('update', 'event')
        ->name('event.cancel_event');
});



// Only access them if a user is an organizer only 

Route::middleware(['role:organizer'])->group(function () {
    Route::get('manage/events/my', [OrganizerEventController::class, 'index'])->name('manage.events.my');
    Route::get('manage/event/create', [OrganizerEventController::class, 'create'])->name('manage.event.create');
    Route::post('manage/event/store',[OrganizerEventController::class, 'store'])->name('manage.event.store');
});



// Event Actions as an organizer (actions to be taken if only its own event)
Route::middleware(['can:is_organizer,event'])->group(function () {
    Route::get('/event/{event}/edit',[OrganizerEventController::class, 'edit'])->name('manage.event.edit');
    Route::post('/event/{event}/update',[OrganizerEventController::class, 'update'])->name('manage.event.update');
    Route::delete('/event/{event}/delete',[OrganizerEventController::class, 'delete'])->name('manage.event.delete');
    // categories,manage.event.update
});






// auth()->user()->hasRole('admin')





