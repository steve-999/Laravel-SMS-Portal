<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessagesController extends Controller
{
    /**
     * Show the list of messages sent by the system.
     *
     * @return Response
     */
    public function index()
    {
        $messages = Message::all()->sortByDesc('created_at');
        $keys = ['msg_id', 'user_id', 'src_number', 'dst_number', 'body', 'status', 'created_at', 'updated_at'];
        return view('messages.index', ['messages' => $messages, 'keys' => $keys]);
    }

    public function show()
    {    
        $msg_id = request('msg_id');
        return view('messages.show', ['msg_id' => $msg_id]);
    }

    public function create()
    {    
        return view('welcome');
    }
}
