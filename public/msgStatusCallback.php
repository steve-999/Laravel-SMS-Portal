<?php

function create_env_array() {
    $env_path = '../.env';
    $contents = file_get_contents($env_path);
    $lines = explode("\n", $contents);
    $env = [];
    foreach($lines as $line) {
        if(empty($line))
            continue;
        $a = explode("=", $line);
        $env[$a[0]] = $a[1];
    }
    return $env;
}


$datetime = date('Y_m_d H_i');
echo 'hello world '. $datetime;

$msg_id = $_GET['msg_id'];

$str = "msg_id: $msg_id\n";

foreach ($_POST as $param_name => $param_val) {
    $str .= "$param_name: $param_val\n";
}

$status = $_POST['MessageStatus'];
$twilio_msg_id = $_POST['MessageSid'];

$msg_id_pattern = '/^[0-9A-Za-z]+$/';
$status_pattern = '/^[A-Za-z]+$/';

$str .= 'twilio_msg_id regex = ' . preg_match($msg_id_pattern, $twilio_msg_id) . "\n";
$str .= 'status regex = ' . preg_match($status_pattern, $status) . "\n";

$env = create_env_array();

if (preg_match($msg_id_pattern, $twilio_msg_id) && preg_match($status_pattern, $status)) {

    $link = mysqli_connect($env['DB_HOST'], $env['DB_USERNAME'], $env['DB_PASSWORD'], $env['DB_DATABASE']);
    if($link === false) {
        $str .= die('ERROR: Could not connect. ' . mysqli_connect_error()) . "\n";
    }
    else {
        $str .= "Connected\n";
    }

    $sql = "UPDATE messages SET status='$status', twilio_msg_id='$twilio_msg_id' WHERE msg_id = $msg_id";
    $str .= $sql . "\n";

    if(mysqli_query($link, $sql)) {
        $str .= "Records were updated successfully.\n";
    } else {
        $str .= "SQL error: $sql. " . mysqli_error($link) . "\n";
    }

    mysqli_close($link);
}
else {
    $str .= "regex failed\n";
}

//echo $str;

$path = "./temp/$datetime.txt";
file_put_contents($path, $str);

?>