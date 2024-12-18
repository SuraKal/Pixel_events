<?php

namespace App\Http\Controllers\User;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AttendeeEvent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    //

    public function index()
    {
        // Fetch attended events with the pivot 'status' and group by status
        $events = Auth::user()->attendedEvents->groupBy(function ($event) {
            return $event->pivot->status; // Group by the 'status' from the pivot table
        });

        // Get cancelled events (if any)
        $cancelled_events = $events->get('cancelled', collect()); // Default to empty collection if no cancelled events

        // Optionally, you can get other statuses like 'active', 'completed' the same way
        $active_events = $events->get('registered', collect()); // Example for active events


        // dd($events);
        // Return to the view with the grouped events
        return view('user.events.index', [
            'events' => $active_events,            // All grouped events by status
            'cancelled_events' => $cancelled_events, // Cancelled events
            // 'active_events' => $active_events  // Active events (or other statuses)
        ]);
    }


    public function attend(Event $event)
    {
        // Check if the user is already registered for the event
        if ($event->attendees()->where('user_id', Auth::user()->id)->exists()) {
            // Return with an error message if already registered
            return redirect()->back()->with('error', 'You have already registered for the event.');
        }

        // Sync without detaching if the user is not already registered
        $event->attendees()->syncWithoutDetaching([Auth::user()->id]);

        // Return with a success message after successful registration
        return redirect()->back()->with('success', 'You have successfully registered for the event.');
    }


    public function re_register(Event $event)
    {
        $attendanceRecord = $event->attendees()
            ->where('user_id', Auth::id())
            ->first();

        if (!$attendanceRecord) {
            return redirect()->back()->with('error', 'No registration record found.');
        }

        if ($attendanceRecord->pivot->status === 'cancelled') {
            $attendanceRecord->pivot->update(['status' => 'registered']);
            return redirect()->back()->with('success', 'You have successfully re-registered for the event.');
        }

        return redirect()->back()->with('info', 'You are already registered for this event.');
    }


    public function cancel_event(Event $event){

        $attendanceRecord = $event->attendees()
            ->where('user_id', Auth::id())
            ->first();

        if (!$attendanceRecord) {
            return redirect()->back()->with('error', 'No registration record found.');
        }

        if ($attendanceRecord->pivot->status === 'registered') {
            $attendanceRecord->pivot->update(['status' => 'cancelled']);
            return redirect()->back()->with('success', 'You have successfully cancelled for the event.');
        }

        return redirect()->back()->with('info', 'You are already cancelled for this event.');

    }

    


}
