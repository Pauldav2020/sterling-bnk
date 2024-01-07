<?php
session_start();
require_once './../../config/config.php';
$user_Ref = 'REG-8236188';

$msg_sql = mysqli_query($conn, "SELECT * FROM chats WHERE user_id='$user_Ref' ORDER BY id ASC")

?>

<?php 
    if(mysqli_num_rows($msg_sql)> 0){
        while($row = mysqli_fetch_assoc($msg_sql)){ 
                $fetctAvatar = mysqli_query($conn, "SELECT * FROM OnBanking WHERE user_ref ='$user_Ref'");
                $avatar = mysqli_fetch_assoc($fetctAvatar);
            ?>
            <div class="containered">
                <img src="./../cust/<?=$avatar["image"]?>" alt="Avatar" style="width:100%;">
                <p><?=$row['messages']?></p>
                <span class="time-right"><?=$row['time']?></span>
            </div>
       <?php  } ?>
    <?php } else {?>

    <?php }?>