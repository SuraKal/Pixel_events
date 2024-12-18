<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //

    public function edit(){
        return view('user.profile.edit');
    }

    public function update(Request $request){
        // dd($request->email);
        $attributes = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email']
        ]);
        $request->user()->fill($attributes);
        $request->user()->save();
        return redirect(route('profile.edit'))->with('success', 'Successfully Updated');
    }
}


