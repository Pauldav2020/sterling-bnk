<?php
    session_start();
    require_once './../../config/config.php';

    //$userRef = $_SESSION['user']['user_ref'];
    $user_Ref = 'REG-8236188';
    function clean($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        return $data;
    }

    $msg = clean($_POST['chats']);
    $msg_ref = "MSG_" . rand(000000,999999);
    $time = date('h:i');
    $date = date('y-m-d');
    $sql = "INSERT INTO chats(user_id,messages,message_ref,time,date, user_status) VALUES('$user_Ref','$msg','$msg_ref', '$time', '$date', 'receiver')";
    if($conn->query($sql)){
        echo json_encode(array('status' => 'success', "codes" => $msg));
    }else{
        json_encode(array('status' => 'failed'));
    }
   
    
    