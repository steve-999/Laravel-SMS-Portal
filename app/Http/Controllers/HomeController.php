<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        //error_log($user);
        $keys = ['name', 'email', 'relationship'];
        return view('home', ['user' => $user, 'keys' => $keys, 'user_id' => $user_id]);
    }

    public function store(Request $request) 
    {
        $user_id = $request['user_id'];
        $name = $request['name'];
        $email = $request['email'];
        $relationship = $request['relationship'];

        DB::table('users')
            ->where('id', '=', $request['user_id'])
            ->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'relationship' => $request['relationship']
            ]);

        return redirect('/home');
    }

}
