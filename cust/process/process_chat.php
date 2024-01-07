<?php
    session_start();
    require_once '../config/config.php';
    //$userRef = $_SESSION['user']['user_ref'];
    $user_Ref = 'REG-8236188';
    function clean($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        return $data;
    }

    $msg = mysqli_real_escape_string($conn, clean($_POST['chats']));
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $msg_ref = "MSG_" . rand(000000,999999);
    $time = date('h:i');
    $date = date('y-m-d');
    $sql = "INSERT INTO chats(incoming_msg_id,outgoing_msg_id,messages,status,time,date) VALUES('{$incoming_id}','{$outgoing_id}', '{$msg}', 1,'$time', '$date')";
    if($conn->query($sql)){
        echo json_encode(array('status' => 'success', "codes" => $msg));
    }else{
        json_encode(array('status' => 'failed'));
    }
   
    
    