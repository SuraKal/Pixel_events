<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
    //

    public function landing() {
        // Retrieve all events with their categories, sorted by 'featured' and latest first
        $events = Event::with( 'category' )
        ->withCount(['attendees as registered_count' => function ($query) {
            $query->where('status', 'registered');
        }])
        ->where( 'status', 'approved' )
        ->orderBy( 'id', 'desc' )
        ->latest()
        ->get();

        // Separate featured events for specific use if needed
        $featured_events = $events->where( 'featured', 1 );


        // dd( $featured_events[ 0 ]->category );
        // Pass both all events and featured events to the view
        return view( 'public.welcome', [
            'events' => $events,
            'featured_events' => $featured_events,
        ] );
    }

}
