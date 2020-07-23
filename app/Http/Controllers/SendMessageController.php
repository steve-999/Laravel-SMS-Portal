<?php
namespace App\Http\Controllers;

use App\Message;
use Auth;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SendMessageController extends Controller
{
    /**
     * Show the forms with users phone number details.
     *
     * @return Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Validate destination phone number and message body
     */
    public function sendMessage(Request $request)
    {
        error_log(strlen($request['message']));
        $validatedData = $request->validate([
            'phone_number' => 'required',
            'message' => 'required|max:140',
        ]);
        $dest_number = $validatedData["phone_number"];
        $message = $validatedData["message"];
    
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        //$client = new Client($account_sid, $auth_token);
        //$client->messages->create($dest_number, ['from' => $twilio_number, 'body' => $message]);

        $msg = new Message();
        $msg->user_id = Auth::user()->id;
        $msg->src_number = $twilio_number;
        $msg->dst_number = $dest_number;
        $msg->body = $message;
        $msg->status = 'Queued';
        $msg->save();
        return back()->with(['success' => "Message sent!"]);
    }
}



