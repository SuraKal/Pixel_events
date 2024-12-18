<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function pending_events(){
        $events = Event::with('category')
            ->withCount(['attendees as registered_count' => function ($query) {
                $query->where('status', 'registered');
            }])
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.events.approve', [
            'events' => $events
        ]);
    }


    public function update(Event $event)
    {
        $event->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Event Approved');
    }

}

