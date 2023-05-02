<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    // this function is used to show the register page
    public function create()
    {
        return view('register.create');
    }
    // this function for  stor New user or create a New user
    public function store()
    {
        // dd(request()->all());

        // validate the data
        $attributes = request()->validate([
            'name' => 'required|min:3|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email|max:255|min:3',
            'password' => 'required|min:3|max:255|confirmed|'
        ]);
        // hash the password
        $attributes['password'] = bcrypt($attributes['password']);

        // first way to create user

        $user = User::create($attributes);
        auth()->login($user);

        session()->flash('success', 'User created successfully');

        // or the second way to create user
        // $user = new User();
        // $user->name = $attributes['name'];
        // $user->email =$attributes['email'];
        // $user->password = bcrypt($attributes['password']);
        // $user->save();

        // or the third way to create user
        // User::create([
        //     'name'=>$attributes['name'],
        //     'email'=>$attributes['email'],
        //     'password'=>bcrypt($attributes['password']);
        //     ]);

        // redirect
        return redirect('/');
    }
}
