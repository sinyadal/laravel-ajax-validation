<?php

namespace App\Http\Controllers;

use App\User;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    public function create() 
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request) 
    {
        // Validation is in here -> app/Http/Requests/UserRequest.php
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('$request->password')
        ]);
        // Session::flash('success_message', 'User created successfully!');
        // return response()->json(['success' => true]);
        // return redirect()->back();
    }
}
