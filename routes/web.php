    <?php

    // Public Controllers
    use App\Http\Controllers\Public\{
        HomeController as PublicHomeController, 
        EventController as PublicEventController, 
        CategoryController as PublicCategoryController, 
        SearchController as PublicSearchController
    };

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


    use Illuminate\Support\Facades\Route;

    // ---------Public------------//

    Route::get( '/', [ PublicHomeController::class, 'landing' ] )->name( 'home' );
    // Category
    Route::get( '/category/{category}', [ PublicCategoryController::class, 'events' ] )->name( 'category.events' );
    Route::get( '/categories', action: [ PublicCategoryController::class, 'index' ] )->name( 'categories' );

    // Event
    Route::get( '/events', [ PublicEventController::class, 'index' ] )->name( 'events' );


    // show only if it is events' organizer or an admin ... or event status is approved


    // Route::middleware(['can:view_event,event'])->group(function () {
        Route::get('/event/{event}', [PublicEventController::class, 'show'])->name('event.show');
    // });

    // Route::middleware(['guest'])->group(function () {
    //     Route::get('/event/{event}', [PublicEventController::class, 'show'])->name('event.show');
    // });

    // Route::middleware(['auth'])->group(function () {
    //     Route::middleware(['can:view_event,event'])->group(function () {
    //         Route::get('/event/{event}', [PublicEventController::class, 'show'])->name('event.show');
    //     });
    // });










    // Serach
    Route::get( '/search', PublicSearchController::class )->name( 'search' );


    // Common routes for all user (user, admin or organizer)
    Route::middleware(['auth', 'role_or:attendee,organizer,admin'])->group(function () {
        Route::get('/profile', [UserProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::post('/profile', [UserProfileController::class, 'update'])
            ->name('profile.update');

        Route::post('/password', [AuthPasswordController::class, 'update'])
            ->name('password.update');
    });




    // Routes for organizer and admin

    Route::middleware(['auth','can:is_organizer_or_admin,event'])->group(function () {


        Route::post('/event/{event}/attendee',[OrganizerEventController::class, 'attendee'])->name('manage.event.attendee');
    });



    // Route for users and organizer only
    Route::middleware(['auth', 'role_or:attendee,organizer'])->group(function () {
        require __DIR__.'/user.php';
    });


    // Route for admin only
    Route::middleware(['auth', 'role:admin'])->group(function () {
        require __DIR__.'/admin.php';
    });


    // Route for authentication only
    require __DIR__.'/auth.php';

