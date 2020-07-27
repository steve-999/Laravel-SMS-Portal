<?php
namespace App\Http\Controllers;

use App\Message;
use Auth;
use DB;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Redis;


class SendMessageController extends Controller
{
    /**
     * Show the forms with users phone number details.
     *
     * @return Response
     */
    public function index()
    {
        $user_logged_in = Auth::check() ? 'true' : 'false';
        error_log('user_logged_in ' . ($user_logged_in));
        return view('welcome', ['user_logged_in' => $user_logged_in]);
    }


    public function sendMessage(Request $request)
    {
        $phone_number_pattern = '/^(\+447|07)\d{3}\s?\d{6}$/';
        $msg_body_length = strlen($request["message"]);     // use htmlspecialchars?
        if(preg_match($phone_number_pattern, $request["phone_number"]) && $msg_body_length > 0 && $msg_body_length <= 140)
        {        
            $messageData = [
                'account_sid' => getenv("TWILIO_SID"),
                'auth_token' => getenv("TWILIO_AUTH_TOKEN"),
                'twilio_number' => getenv("TWILIO_NUMBER"),
                'dest_number' => $request["phone_number"],
                'body' => $request["message"],
                'user_id' => Auth::user()->id,
            ];
            $this->dispatch(new \App\Jobs\SendMessage($messageData));
        }
    }
}



