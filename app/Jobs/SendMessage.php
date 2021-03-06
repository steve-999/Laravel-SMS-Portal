<?php

namespace App\Jobs;

use App\Message;
use DB;
use Illuminate\Support\Facades\Redis;
use Twilio\Rest\Client;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $messageData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($messageData)
    {
        $this->messageData = $messageData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $account_sid = $this->messageData['account_sid'];
        $auth_token = $this->messageData['auth_token'];
        $twilio_number = $this->messageData['twilio_number'];
        $dest_number = $this->messageData['dest_number'];
        $body = $this->messageData['body'];
        $user_id = $this->messageData['user_id'];
        
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

        $ip_address = env('MY_IP_ADDRESS');
        $callback_url = "http://$ip_address/sms-portal/public/msgStatusCallback.php?msg_id=" . $msg_id;
        $created_at_ts = Redis::hget($user_id, 'created_at');

        while(Redis::exists($user_id)) {
            $created_at_ts = Redis::hget($user_id, 'created_at');
            sleep(1);
        }

        $client = new Client($account_sid, $auth_token);
        $client->messages->create($dest_number, ['from' => $twilio_number, 'body' => $body, 'StatusCallback' => $callback_url]);

        $message = DB::table('messages')
            ->orderBy('messages.created_at', 'DESC')
            ->first();
        $msg_id = $message->msg_id;

        $expire_in_seconds = 15;
        Redis::hset($user_id, 'created_at', time());
        Redis::expire($user_id, $expire_in_seconds);
        //$created_at_ts = Redis::hget($user_id, 'created_at');
    }
}
