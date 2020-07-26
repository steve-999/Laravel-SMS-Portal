<?php


$datetime = date('Y_m_d H_i');
echo 'hello world '. $datetime;

$msg_id = $_GET['msg_id'];

$str = "msg_id: $msg_id\n";
foreach ($_POST as $param_name => $param_val) {
    $str .= "$param_name: $param_val\n";
}

$path = "./temp/$datetime.txt";
file_put_contents($path, $str);


// $link = mysqli_connect("localhost", "steve", "filter1234", "sms_portal");
// if($link === false){
//     die("ERROR: Could not connect. " . mysqli_connect_error());
// }
// else {
//     echo 'connected';
// }


// $sql = "UPDATE messages SET status='delivered temp' WHERE msg_id=$msg_id";
// if(mysqli_query($link, $sql)){
//     echo "Records were updated successfully.";
// } else {
//     echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
// }




mysqli_close($link);

?>