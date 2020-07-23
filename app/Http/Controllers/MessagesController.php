<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use DB;

class MessagesController extends Controller
{
    /**
     * Show the list of messages sent by the system.
     *
     * @return Response
     */
    public function index()
    {
        $messages = DB::table('messages')
            ->leftJoin('users', 'messages.user_id', '=', 'users.id')
            ->orderBy('messages.created_at', 'DESC')
            ->get();
        $keys = ['msg_id', 'user_id', 'src_number', 'dst_number', 'body', 'name', 'email', 'relationship', 'status', 'created_at', 'updated_at'];
        return view('messages.index', ['messages' => $messages, 'keys' => $keys]);
    }

    public function show($msg_id)
    {    
        $message = DB::table('messages')
            ->leftJoin('users', 'messages.user_id', '=', 'users.id')
            ->where('messages.msg_id', '=', $msg_id)
            ->first();        
        $keys = ['msg_id', 'user_id', 'src_number', 'dst_number', 'body', 'name', 'email', 'relationship', 'status', 'created_at', 'updated_at'];
        //error_log(serialize($message));
        return view('messages.show', ['message' => $message, 'keys' => $keys]);
    }
}
