<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
/**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(6)]
        ];
    }


    
    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function authenticate(): void
    // {
    //     // $this->ensureIsNotRateLimited();

    //     // if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
    //     //     RateLimiter::hit($this->throttleKey());

    //     //     throw ValidationException::withMessages([
    //     //         // 'email' => trans('auth.failed'),
    //     //         'email' => 'Sorry, those credentials do not match.',
    //     //     ]);
    //     // }

    //     if (! Auth::attempt($this->only('email', 'password'))) {
    //         throw ValidationException::withMessages([
    //             'email' => 'Sorry, those credentials do not match.',
    //         ]);
    //     }

    //     // RateLimiter::clear($this->throttleKey());
    // }





}
