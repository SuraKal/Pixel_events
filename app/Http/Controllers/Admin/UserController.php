<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    //
    public function index(){
        $users = User::with('roles')
                        ->withCount('registeredAttendedEvents')
                        ->withCount('organizedEvents')
                        ->whereDoesntHave('roles', function ($query) {
                            $query->where('name', 'admin');
                        })
                        ->latest()
                        ->get();
        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function create(){
        $roles = Role::select('id', 'name')
                        ->latest()    
                        ->get()
                        ;
        return view('admin.users.create', [
            'roles' => $roles
        ]);
    }

        public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)],
            'profile' => ['nullable', 'image', File::types(['png', 'jpg', 'webp'])],
            'role' => ['required'],
        ]);

        
        // Handle profile image upload or fallback to a placeholder
        $logoPath = $request->hasFile('profile') 
            ? $request->file('profile')->store('images', 'public') 
            : fake()->imageUrl(600, 400, 'nature');

        $validatedData['profile'] = $logoPath;

        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'profile' => $validatedData['profile'],
        ]);

        // Attach the role
        $user->roles()->attach($validatedData['role']);


        
        // Redirect to the home page or a relevant page
        return redirect(route('admin.users.index'))->with('success', 'Registration successful!');
    }

    public function edit(User $user){
        $roles = Role::select('id', 'name')
                        ->latest()    
                        ->get()
                        ;
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, User $user)
    {
        $attr = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id]
        ]);

        $user->update($attr);

        return redirect()->back()->with('success', 'Profile Updated');
    }

    public function destroy(User $user){
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User Deleted Successfully');

    }

    public function attended_events(User $user){

        $events = $user->attendedEvents()
                    ->withCount(['attendees as registered_count' => function ($query) {
                        $query->where('status', 'registered');
                    }])
                    ->wherePivot(
                        'status' ,'registered'
                    )
                    ->get()
        ;
        

        return view('admin.users.attended_events', [
            'events' => $events,            // All grouped events by status
            'user_name' => $user->name
            // 'active_events' => $active_events  // Active events (or other statuses)
        ]);
    }


    public function organized_events(User $user) {
        $events = $user->organizedEvents()
                        ->withCount(['attendees as registered_count' => function ($query) {
                            $query->where('status', 'registered');
                        }])
                        ->latest()
                        ->where('status', 'approved')
                        ->get();

        return view('admin.users.organized_events', [
            'events' => $events,
            'user_name' => $user->name

        ]);
    }

}


