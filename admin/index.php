<?php
require_once '../config/config.php';
require_once './includes/reg-header.php';
require_once './process.php';
require_once './process_cards.php';

$admin_Ref = $_SESSION['admin']['user_ref'];


$sn = 1;

//search query
if (isset($_POST["search"])) {
    $search = $_POST["users"];
} else {
    $search = "";
}
if (isset($_POST["yes"])) {
    $loginActive = $_POST["activate"];
    $sql  = mysqli_query($conn, "SELECT * FROM OnBanking WHERE user_ref = '$loginActive'");
    if (mysqli_num_rows($sql) > 0) {
        $fetchUsers = mysqli_fetch_array($sql);
        if ($fetchUsers['valid_user'] == "Pending") {
            $sql  = mysqli_query($conn, "UPDATE OnBanking SET valid_user='Approved' WHERE user_ref = '$loginActive'");
            if ($sql == true) {
                echo "<script>alert('Login has been approved');window.location.href='dashboard'</script>";
            } else {
                echo "<script>alert('Login failed');window.location.href='dashboard'</script>";
            }
        } else {
            $sql  = mysqli_query($conn, "UPDATE OnBanking SET valid_user='Pending' WHERE user_ref = '$loginActive'");
            if ($sql == true) {
                echo "<script>alert('Login has been suspended');window.location.href='dashboard'</script>";
            } else {
                echo "<script>alert('Login failed');window.location.href='dashboard'</script>";
            }
        }
    }
}

//fetch notifications
$Notificaton = mysqli_query($conn, "SELECT * FROM chats WHERE NOT outgoing_msg_id='$admin_Ref' AND status='1'")

?>
<style>
    .cards-btn{
        background: blue;
    }
    .cards-btn.active{
        background-color: red;
    }
    .content{
        display: none;
    }
    .content.active{
        display: block;
    }
</style>

<div class="container-fluid">
    <div class="column" id="column">
        <div class="colum-small">
            <div class="buttons">
                <div class="menu-list" id="menu-list">
                    <div class="profile">
                        <div class="pic-container">
                            <div class="greetings">
                                <span class="tiemIndictor"><?= timeIndicator2() ?></span>
                                <h4 class="cust-Name"><?= $fetch['Names'] ?></h4>
                            </div>
                        </div>
                    </div>
                    <ul class="list-items">
                        <li> <a href="#" class="bg-danger">USERS</a></li>
                        <li> <a href="./history.php">ACCOUNT HISTORY</a></li>
                        <li> <a href="./codes.php">BILLING CODES</a></li>
                        <li> <a href="./transfer_restrict.php">BLOCK/OPEN TRANSFER</a></li>
                        <li> <a href="./activate.php">ACTIVATE ACC</a></li>
                        <li>
                            <a href="./chats.php" class="chats">CHATS
                                <?php if (mysqli_num_rows($Notificaton) > 0) {
                                    echo  '<div class="notify">' . mysqli_num_rows($Notificaton) . '</div>';
                                } ?>
                            </a>
                        </li>
                        <li> <a href="./edit_profile.php">EDIT PROFILE</a></li>
                        <li> <a href="./delete_cust.php">DELETE USER</a></li>
                        <li> <a href="./sign_out.php">SIGNOUT</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="column-large" id="col-large">
            <!-- show customer otp codes starts here -->
           
                <?php
                    if(isset($_GET['otp'])){
                        $user_ref = base64_decode($_GET['otp']);
                        $sqlOtp = mysqli_query($conn, "SELECT * FROM otp WHERE user_ref = '$user_ref'");
                        $fetchotp = mysqli_fetch_assoc($sqlOtp);
                        ?>
                        <div class="cust-otp">
                            
                        <form  method="post" class="content">
                            <span class="close" onclick="document.querySelector('.cust-otp').style.display = 'none'">&times;</span>
                            <h4 style="color: green"><?=$fetchotp['username']?></h4>
                            <p>Your login verification code is:</p>
                            <h4><?=$fetchotp['otp_code']?></h4>
                        </form>
                        </div>
                   <?php }
                ?>
            
            <!-- show otp codes end here -->
            <?php
            if (isset($_GET['login_activate'])) {
                $loginId = base64_decode($_GET['login_activate']);
            ?>
                <form action="" method="post" class="alert alert-info w-50 mx-auto text-center">
                    <input type="hidden" name="activate" value="<?= $loginId ?>">
                    <p>Are you Sure?</p>
                    <input type="submit" class="btn btn-danger btn-sm" name="yes" value="YES">
                    <a href="dashboard" class="btn btn-sm btn-info">NO</a>
                </form>
            <?php } else { ?>
                <form action="" method="post">
                    <p>Search Result:<?= $search ?> </p>
                    <input type="text" name="users" id="user-Search" value="<?= $search ?>" placeholder="Search Users here">
                    <button type="submit" name="search">Search</button>
                </form>
                <?php if (isset($_GET['cards'])) { 
                        $user_id = base64_decode($_GET['cards'])
                    ?>

                    <div class="shadow-lg w-25 mt-5 p-4 mx-auto bg-light">
                        <div class="d-flex">
                            <button data-info="#credit" class="btn w-50 d-inline-block mx-2 text-white cards-btn active">Credit</button>
                            <button data-info="#update" class="btn w-50 d-inline-block text-white cards-btn">Update</button>
                        </div>
                        <form action="" method="POST" class="content active" id="credit">
                            <select name="cards" id="" class="form-control p-0 w-50 mt-3" required>
                                <option value="">Select Cards</option>
                                <option value="visa">Visa Card</option>
                                <option value="master">Master Card</option>
                            </select>
                            <input type="hidden" name="userId" value="<?=$user_id?>" />
                            <input type="text" placeholder="Enter Amount"" name="amount" class="form-control my-3 amt" onkeypress="return(event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required>
                            <span class="text-danger d-block" id="amt_error"></span>
                            <button class="btn btn-success w-100" name="credit_cards">Credit</button>
                            <p class="text-primary mt-3 fw-bold">Credit cards here</p>
                        </form>
                        <form action="" method="POST" class="content" id="update">
                            <select name="cards" id="" class="form-control p-0 w-50 mt-3">
                                <option value="">Select Cards</option>
                                <option value="visa">Visa Card</option>
                                <option value="master">Master Card</option>
                            </select>
                            <input type="hidden"  name="userId" value="<?=$user_id?>" />
                            <input type="text" placeholder="Update Amount" name="amount"  class="form-control my-3 amt" onkeypress="return(event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                            <span class="text-danger d-block" id="amt_error"></span>
                    
                            <button class="btn btn-success w-100" name="update_cards">Update</button>
                            <p class="text-danger fw-bold mt-3">Update amount here</p>
                        </form>
                    </div>
                <?php } else { ?>
                    <table class="table table-striped  table-hover" id="searchShow">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>IMAGE</th>
                                <th>USERNAME</th>
                                <th colspan='3'>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $team = $search;
                            $users = mysqli_query($conn, "SELECT * FROM OnBanking WHERE username LIKE '%$team%' AND role='customer' ORDER BY id DESC");
                            while ($row = mysqli_fetch_assoc($users)) { ?>
                                <tr>
                                    <td><?= $sn++ ?></td>
                                    <td><img style="width: 100px;" src="./<?= $row['image'] ?>" alt=""></td>
                                    <td><?= $row['username'] ?></td>
                                    <td><a href="./transfer.php?id=<?= base64_encode($row['user_ref']) ?>" class='btn btn-primary' onclick="fund()">Fund Acc</a></td>
                                    <td><a href="?cards=<?= base64_encode($row['user_ref']) ?>" class='btn btn-primary' onclick="fund()">Fund Cards</a></td>
                                    <td><a href="?login_activate=<?= base64_encode($row['user_ref']) ?>" style="background: none">
                                        <?php
                                        $check = $row['user_ref'];
                                        $checkBase = mysqli_query($conn, "SELECT * FROM OnBanking WHERE user_ref='$check'");
                                        $fetchBase = mysqli_fetch_assoc($checkBase);
                                        if ($fetchBase['valid_user'] == 'Pending') { ?>
                                            <button class='btn btn-danger'>activate_Login</button>
                                        <?php } else { ?>
                                            <button class='btn btn-primary'>Login_activated</button>
                                        <?php  }
                                        ?>
                                        </a>
                                        <a href="?otp=<?=base64_encode($row['user_ref'])?>" class="btn btn-danger otp-btn">Login OTP</a> 
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    const contents = document.querySelectorAll('.content')
    const cardsBtn = document.querySelectorAll('.cards-btn');
    cardsBtn.forEach(btn => {
        btn.addEventListener('click', (e) => {
            cardsBtn.forEach(btn => btn.classList.remove('active'))
            contents.forEach(content => content.classList.remove('active'))
            e.target.classList.add('active');
            const attribute = e.target.getAttribute('data-info')
            const getContent = document.querySelector(attribute)
            getContent.classList.add('active')
        });
    })


  let amts = document.querySelectorAll(".amt");
amts.forEach( amt => {
  amt.onkeyup = function(){
    // alert("it fines in here")
    var currentVal = $(this).val();
      var testDecimal = testDecimals(currentVal);
      if (testDecimal.length > 1) {
          $("#amt_error").html("You cannot enter more than one decimal point");
          currentVal = currentVal.slice(0, -1);
      }else{
          $("#amt_error").html("");
      }
      $(this).val(replaceCommas(currentVal));
  }
  
  function testDecimals(currentVal) {
      var count;
      currentVal.match(/\./g) === null ? count = 0 : count = currentVal.match(/\./g);
      return count;
  }
  
  function replaceCommas(yourNumber) {
      var components = yourNumber.toString().split(".");
      if (components.length === 1)
          components[0] = yourNumber;
      components[0] = components[0].replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      if (components.length === 2)
          components[1] = components[1].replace(/\D/g, "");
      return components.join(".");
  }
})
</script>

<?php require_once './includes/dash_footer.php'; ?>