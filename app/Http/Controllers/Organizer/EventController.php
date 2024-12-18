<?php

namespace App\Http\Controllers\Organizer;

use App\Models\Event;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;

class EventController extends Controller
{
    //Organizer event management specific logics
    // public function index(){
    //     $events = Event::with('category')
    //                 ->latest()
    //                 ->get()
    //                 ->where(
    //                     'user_id', Auth::user()->id
    //                 );

    //     return view('organizer.events.index', [
    //         'events' => $events
    //     ]);
    // }

    public function index() {
        $events = Event::with('category')
            ->withCount(['attendees as registered_count' => function ($query) {
                $query->where('status', 'registered');
            }])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('organizer.events.index', [
            'events' => $events
        ]);
    }



    public function create(){
        $categories = Category::all();
        return view('organizer.events.create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        // Validate all attributes in one step
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'date' => ['required', 'date'],
            'location' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'string', 'max:255'],
            // 'image' => ['nullable', 'image', File::types(['png', 'jpg', 'webp'])]
        ]);

        $validateImage = $request->validate([
            'image' => ['nullable', 'image', File::types(['png', 'jpg', 'webp'])]
        ]);

        // Handle profile image upload with a fallback
        $imagePath = $request->hasFile('image') 
            ? $request->file('image')->store('images', 'public') 
            : config('app.default_image_path'); // Use a default placeholder path

        // Add the authenticated user's ID to the attributes
        $validated['user_id'] = Auth::id();

        // Create the event and associate the image
        $event = Event::create($validated);

        $event->images()->create([
            'image_path' => $imagePath,
        ]);

        return redirect()->route('manage.events.my')->with('success', 'Event successfully created.');
    }


    public function attendee(Event $event){
        $attendees = $event->attendees;
        return view('organizer.events.attendee', [
            'attendees' => $attendees
        ]);
    }

    public function edit(Event $event){
        $categories = Category::all();
        return view('organizer.events.edit', [
            'event' => $event,
            'categories' => $categories
        ]);
    }

    public function update(Event $event){

        $attributes = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'date' => ['required', 'date'],
            'location' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'string', 'max:255']
        ]);

        $event->update($attributes);


        return redirect(route('manage.event.edit', $event))->with('success', 'Successfully Updated');

    }
    

    public function delete(Event $event){
        // dd($event);
        $event->delete();
        return redirect(route('manage.events.my'))->with('success', 'Successfully Deleted');
    }





}

