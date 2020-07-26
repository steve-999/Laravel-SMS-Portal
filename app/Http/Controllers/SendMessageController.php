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
        return view('welcome');
    }

    /**
     * Validate destination phone number and message body
     */
    public function sendMessage(Request $request)
    {
        //error_log('in sendMessage', strlen($request['message']));
        // $validatedData = $request->validate([
        //     'phone_number' => 'required',
        //     'message' => 'required|max:140',
        // ]);
         
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $dest_number = $request["phone_number"];
        $body = $request["message"];        

        $user_id = Auth::user()->id;
        $msg = new Message();
        $msg->user_id = $user_id;
        $msg->src_number = $twilio_number;
        $msg->dst_number = $dest_number;
        $msg->body = $body;
        $msg->status = 'queued';
        $msg->save();

        $message = DB::table('messages')
            ->orderBy('messages.created_at', 'DESC')
            ->first();
        $msg_id = $message->msg_id;
        error_log('new msg_id ' . $msg_id);


        $callback_url = 'http://81.108.2.236/sms-portal/public/msgStatusCallback.php?msg_id=' . $msg_id;
        error_log($dest_number);
        error_log($callback_url);
    
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($dest_number, ['from' => $twilio_number, 'body' => $body,
            'StatusCallback' => $callback_url]);

        error_log('in sendMessage after create message');

        $message = DB::table('messages')
            ->orderBy('messages.created_at', 'DESC')
            ->first();
        $msg_id = $message->msg_id;
        error_log('new msg_id after ' . $msg_id);

        $expire_in_seconds = 60;
        //$redis = Redis::connection();
        Redis::hset($user_id, 'created_at', time());
        //Redis::expire($user_id, $expire_in_seconds);
        $msg_id_in_redis = Redis::hget($user_id, 'created_at');
        error_log('$msg_id_in_redis ' . $msg_id_in_redis);

        session()->now('success', 'Message sent!');
        //return back()->with(['success' => "Message sent!"]);
        //return response()->with(['success' => "Message sent!"]);
        //return response()->json(['success'=>'Form has been successfully submitted!']);
    }

    public function xyz()
    {
        //$redis = Redis::connection();
        Redis::set('name', 'Jolyon');
        $name = Redis::get('name');
        error_log($name);
        return view('xyz', ['name' => $name]);
    }
}



