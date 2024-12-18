<?php

namespace App\Http\Controllers\Public;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller {
    //

    public function index() {
        // Retrieve all events with their categories, sorted by 'featured' and latest first
        $events = Event::with( 'category' )
        ->withCount(['attendees as registered_count' => function ($query) {
            $query->where('status', 'registered');
        }])
        ->where( 'status', 'approved' )
        ->orderBy( 'id', 'desc' )
        ->latest()
        ->get();

        return view( 'public.events.index', [
            'events' => $events
        ] );
    }

    public function show(Event $event)
    {
        $user = Auth::user();

        // If user is logged in but does not have permission
        if ($user && $user->cannot('view_event', $event)) {
            abort(403);
        }

        // If user is not logged in and event status is not 'approved'
        if (is_null($user) && $event->status !== 'approved') {
            abort(403);
        }

        return view('public.events.show', [
            'event' => $event
        ]);
    }
    


    public function attend(Event $event){
        $event->attendees()->attach([
            'user_id' => Auth::user()->id
        ]);
        return redirect(route('event.show', $event));
    }
}
