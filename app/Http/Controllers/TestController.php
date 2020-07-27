<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;

use Illuminate\Http\Request;

class TestController extends Controller
{
    
    public function index() {
        $expire_in_seconds = 60;

        $user_id = 3;
        //$redis = Redis::connection();
        Redis::hset($user_id, 'created_at', time());
        //Redis::expire($user_id, $expire_in_seconds);
        sleep(5);
        $created_at_ts = Redis::hget($user_id, 'created_at');
        error_log('$created_at_ts ' . $created_at_ts . ' - ' . time());
        return '$created_at_ts ' . $created_at_ts . ' - ' . time() . ' - ' . (time() - $created_at_ts);
    }

}
