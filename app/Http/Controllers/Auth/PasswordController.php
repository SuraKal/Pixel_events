<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    // public function update(Request $request){
    //     // dd($request->email);
    //     $attributes = $request->validate([
    //         'password' => ['required', 'confirmed', Password::min(6)]
    //     ]);
    //     $request->user()->fill($attributes);
    //     $request->user()->save();
    //     return redirect(route('profile.edit'))->with('success', 'Successfully Updated');
    // }

    public function update(Request $request): RedirectResponse
    {
        // $validated = $request->validateWithBag('updatePassword', [
        //     'current_password' => ['required', 'current_password'],
        //     'password' => ['required', Password::defaults(), 'confirmed'],
        // ]);

        $validated = $request->validate( [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);


        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect(route('profile.edit'))->with('success', 'Password Updated');

    }

    
}

