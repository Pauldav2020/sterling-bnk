<?php
require_once './../../config/config.php';
    $admin_Ref = 'REG-1027021';
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nofication = mysqli_query($conn, "SELECT * FROM chats WHERE outgoing_msg_id='{$id}' AND status='1' ");

    if(mysqli_num_rows($nofication) >0) {
        $fetchuser = mysqli_fetch_array($nofication);
        if($fetchuser['outgoing_msg_id'] === $id ){
            echo json_encode(array("status" => mysqli_num_rows($nofication), "outgoing_msg_id" => $fetchuser['outgoing_msg_id'], "ids" => $id));
        }
    } else { 
        echo mysqli_num_rows($nofication);
    } 
?>