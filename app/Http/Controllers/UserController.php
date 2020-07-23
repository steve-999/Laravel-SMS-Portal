<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function signup()
    {
        return view('users.signup');
    }

    public function login()
    {
        return view('users.login');
    }

    public function dashboard()
    {
        return view('users.dashboard');
    }

    public function store() 
    {
        return redirect('/');
    }
}
