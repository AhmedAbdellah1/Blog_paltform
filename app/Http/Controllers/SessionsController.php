<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    // write a function create(session)
    public function create()
    {
        return view('login.create');
    }

    /**
     *  write a function store(session) to send data of  user to database to
     *  check if user exist or not and if exist then redirect to home page
     *  else show error message and redirect to login page again
     */
    public function store()
    {
        // validate the data of the login
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Please check your email and try again',
                'password' => 'Please check your Password and try again'
            ]);
        }
        session()->regenerate();
        return redirect('/')->with('success', 'Welcome Back!');

        // anther way to do the above

        // when attempt to log the user in if successful, redirect to the homepage else redirect back to the login page
        // if (auth()->attempt($attributes)) {
        //     session()->regenerate();
        //     return redirect('/')->with('success', 'Welcome Back!');
        // }

        //  if unsuccessful show error message
        // throw ValidationException::withMessages([
        //     'email' => 'Please check your email and try again',
        //     'password' => 'Please check your Password and try again'
        // ]);
    }

    // write a function destroy(session)
    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Goodbye!');
    }
}
