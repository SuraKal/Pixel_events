<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    //

    public function create(){
        // dd('register form here');
        $roles = Role::all();
        return view('auth.register', [
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

        // Log the user in
        Auth::login($user);

            // Fire the UserRegistered event after the user is created
        // event(new UserRegistered($user));

        
        // Redirect to the home page or a relevant page
        return redirect(route('home'))->with('success', 'Registration successful!');
    }

}
