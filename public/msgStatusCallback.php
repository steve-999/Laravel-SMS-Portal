<?php


$datetime = date('Y_m_d H_i');
echo 'hello world '. $datetime;

$msg_id = $_GET['msg_id'];

$str = "msg_id: $msg_id\n";

foreach ($_POST as $param_name => $param_val) {
    $str .= "$param_name: $param_val\n";
}

$status = $_POST['MessageStatus'];
$twilio_msg_id = $_POST['MessageSid'];

// $status = 'delivered';
// $twilio_msg_id = 'A1234cdefgh';

$msg_id_pattern = '/^[0-9A-Za-z]+$/';
$status_pattern = '/^[A-Za-z]+$/';

$str .= 'regex 1 = ' . preg_match($msg_id_pattern, $twilio_msg_id) . "\n";
$str .= 'regex 2 = ' . preg_match($status_pattern, $status) . "\n";

if (preg_match($msg_id_pattern, $twilio_msg_id) && preg_match($status_pattern, $status)) {

    $link = mysqli_connect('localhost', 'steve', 'filter1234', 'sms_portal');
    if($link === false) {
        $str .= die('ERROR: Could not connect. ' . mysqli_connect_error());
    }
    else {
        $str .= 'Connected';
    }


    $sql = "UPDATE messages SET status='$status', twilio_msg_id='$twilio_msg_id' WHERE msg_id = $msg_id";

    $str .= $sql;

    if(mysqli_query($link, $sql)) {
        $str .= 'Records were updated successfully.';
    } else {
        $str .= "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    mysqli_close($link);
}
else {
    $str .= 'regex failed';
}

echo $str;

$path = "./temp/$datetime.txt";
file_put_contents($path, $str);

?>