<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ {
    EventController as AdminEventController,
    UserController as AdminUserController
};



Route::controller(AdminEventController::class)->group(function () {

    Route::get( '/events/approve', 'pending_events')
    ->name( 'admin.events.approve' );
    Route::post( '/event/{event}/approve', 'update')
    ->name( 'admin.event.approve' );

});


Route::controller(AdminUserController::class)->group(function () {

    Route::get('/users', 'index')
            ->name('admin.users.index');

    Route::get('/user/create', 'create')
                ->name('admin.user.create');

    Route::post('/user/store', 'store')
        ->name('admin.user.store');

    Route::get('/user/{user}/edit', 'edit')
        ->name('admin.user.edit');

    Route::post('/user/{user}/update', 'update')
        ->name('admin.user.update');

    Route::delete('/user/{user}/destroy', 'destroy')
        ->name('admin.user.destroy');

    Route::get('/user/{user}/events/attended', 'attended_events')
        ->name('admin.user.events.attended');

    Route::get('/user/{user}/events/organized', 'organized_events')
        ->name('admin.user.events.organized');


});




