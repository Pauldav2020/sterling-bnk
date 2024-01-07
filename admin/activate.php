<?php 
  require_once './config/config.php';
  require_once './includes/reg-header.php';
  require_once './process.php';
  
  //admin id
  $admin_Ref = 'REG-1027021';
 
  $sn = 1;

  //search query
  if(isset($_POST["search"])){
    $search = $_POST["users"]; 
  }else{
      $search = "";
  }
    

//fetch notifications
$Notificaton = mysqli_query($conn, "SELECT * FROM chats WHERE NOT outgoing_msg_id='$admin_Ref' AND status='1'")
?>

<div class="container-fluid">
    <div class="column" id="column">
        <div class="colum-small">
            <div class="buttons">
                <div class="menu-list" id="menu-list">
                    <div class="profile">
                        <div class="pic-container">
                            <div class="greetings">
                                <span class="tiemIndictor"><?=timeIndicator2()?></span>
                                <h4 class="cust-Name"><?=$fetch['Names']?></h4>
                            </div>
                        </div>
                    </div>
                    <ul class="list-items" >
                    <li> <a href="./dashboard">USERS</a></li>
                    <li> <a href="./history.php">ACCOUNT HISTORY</a></li>
                    <li> <a href="./codes.php">BILLING CODES</a></li>
                    <li> <a href="./transfer_restrict.php">BLOCK/OPEN TRANSFER</a></li>
                    <li> <a href="#" class="bg-danger">ACTIVATE ACC</a></li>
                    <li> <a href="chats.php" class="chats" >CHATS
                        <?php  if(mysqli_num_rows($Notificaton) > 0) {
                            echo  '<div class="notify">'.mysqli_num_rows($Notificaton).'</div>';
                        }?>
                    </a></li>
                    <li> <a href="./edit_profile.php">EDIT PROFILE</a></li>
                    <li> <a href="#">DELETE USER</a></li>
                    <li> <a href="./sign_out.php">SIGNOUT</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="column-large" id="col-large">
            
            <form action="" method="post">
                <p>Search Result:<?=$search?> </p>
                <input type="text" name="users" id="user-Search" value="<?=$search?>" placeholder="Search Users here">
                <button type="submit" name="search">Search</button>
            </form>
            <table class="table table-striped  table-hover" id="searchShow">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>IMAGE</th>
                        <th>USERNAME</th>
                        <th colspan="2" class="text-center">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $team = $search; 
                        $users = mysqli_query($conn,"SELECT * FROM OnBanking WHERE username LIKE '%$team%' AND role='customer' ORDER BY id DESC");
                        while ($row = mysqli_fetch_assoc($users)){?>
                    <tr>
                        <td><?=$sn++?></td>
                        <td><img style="width: 100px;" src="<?=$row['image']?>" alt="image"></td>
                        <td><?=$row['username']?></td>
                        <td>
                            <button id="activate" value="<?=$row['user_ref']?>" style="border: none" class="btn btn-sm">
                            <?php 
                            $user_Rf = $row["user_ref"];
                            $require_codes = mysqli_query($conn, "SELECT * FROM OnBanking WHERE user_Ref='$user_Rf'");
                            $rowActive = mysqli_fetch_assoc($require_codes);
                            if($rowActive['status'] == 'ACTIVE'){?>
                                <span class="btn" style="background-color: blue; border:none;border-radius:10px; color: white;font-weight:bold; cursor: pointer">ACTIVE</span>
                          <?php  }else{?>
                                    <span style="background-color: red; color: white; border:none;border-radius:10px; font-weight: bold;padding: 10px 15px; cursor: pointer">INACTIVE</span>
                            <?php }?>
                          </button> 
                        </td>
                        <td>
                            <button id="blockTransfer" value="<?=$row['user_ref']?>" style="border: none" class="btn btn-sm">
                            <?php 
                            $user_Rf = $row["user_ref"];
                            $require_codes = mysqli_query($conn, "SELECT * FROM OnBanking WHERE user_Ref='$user_Rf'");
                            $rowstate = mysqli_fetch_assoc($require_codes);
                            if($rowstate['state'] == 'OPENED'){?>
                                <span class="btn" style="background-color: blue; border:none;border-radius:10px; color: white;font-weight:bold; cursor: pointer">UNBLOCKED</span>
                          <?php  }else{?>
                                    <span style="background-color: red; color: white; border:none;border-radius:10px; font-weight: bold;padding: 10px 15px; cursor: pointer">BLOCKED</span>
                            <?php }?>
                          </button> 
                        </td>
                    </tr>
                    <?php }?>;
                </tbody>
            </table>
           
        </div>
    </div>   
</div>

<?php require_once './includes/dash_footer.php'; ?>