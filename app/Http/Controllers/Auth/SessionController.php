<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    //
    public function create(){
        return view('auth.login');
    }

    // public function store(LoginRequest $request){
    //     //authenticate
    //     // dd($request);

    //     // $attr = $request->validate([
    //     //     'email' => ['required', 'email'],
    //     //     'password' => ['required', Password::min(6)]
    //     // ]);

    //     // if (! Auth::attempt($attr)) {
    //     //     throw ValidationException::withMessages([
    //     //         'email' => 'Sorry, those credentials do not match.',
    //     //     ]);
    //     // }

    //     // request()->session()->regenerate();

    //     // return redirect('/');

    //     dd('hello');


    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     // return redirect('/');


    //     // return redirect()->intended('/');
    // }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // if(Auth::user()->roles)

        // Route::middleware(['auth', 'role:admin'])
        if(Auth::user()->hasAnyRole(['organizer'])){
            return redirect()->route('manage.events.my');
        }else if(Auth::user()->hasAnyRole(['admin'])){
            return redirect()->route('admin.events.approve');
        }

        


        return redirect()->intended(route('home', absolute: false));
    }

    public function destroy(){
        Auth::logout();
        return redirect(route('home'));
    }
}


