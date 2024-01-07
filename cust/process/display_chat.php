<?php
    session_start();
    require_once '../config/config.php';
    //$user_Ref = mysqli_real_escape_string($conn,'REG-8236188');
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, 'REG-1027021');

    $msg_sql = mysqli_query($conn, "SELECT * FROM chats LEFT JOIN users ON users.reg_Ref = chats.outgoing_msg_id 
    WHERE (outgoing_msg_id = '{$outgoing_id}' AND incoming_msg_id = '{$incoming_id}') 
    OR ( outgoing_msg_id = '{$incoming_id}' AND incoming_msg_id = '{$outgoing_id}' ) ORDER BY msg_id");

  
  
?>

<?php 

if(mysqli_num_rows($msg_sql)> 0){
    
    while($row = mysqli_fetch_assoc($msg_sql)){ 
            $fetctAvatar = mysqli_query($conn, "SELECT * FROM OnBanking WHERE user_ref ='$outgoing_id'");
            $avatar = mysqli_fetch_assoc($fetctAvatar);
        if($row['outgoing_msg_id'] === $outgoing_id ){ ?>
            <div class="containered">
                <img src="../cust/<?=$avatar["image"]?>" alt="Avatar" style="width:100%;">
                <p><?=$row['messages']?></p>
                <span class="time-right"><?=$row['time']?></span>
            </div>
        <?php }else { ?>
            <div class="containered darker">
                <img src="../cust/dash-img/profile.png" alt="Avatar" class="right" style="width:100%;">
                <p><?=$row['messages']?></p>
                <span class="time-left"><?=$row['time']?></span>
            </div>
        <?php  }
    }    
    
} else{
  
    echo '<div class="text">No messages are available. Once you send message they will appear here.</div>';
 } 
 