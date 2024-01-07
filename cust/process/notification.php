<?php
    session_start();
    require_once '../config/config.php';
    $user_Ref = $_SESSION['user']['user_ref'];

    $nofication = mysqli_query($conn, "SELECT * FROM chats WHERE incoming_msg_id='$user_Ref' and status='1'");

    if(mysqli_num_rows($nofication) >0) {
        echo '<div class="badge"></div>' . mysqli_num_rows($nofication);
    } else { 
        echo mysqli_num_rows($nofication);
    } 
?>
