<?php
require './includes/new_header.php';
//require './includes/reg-header.php';

include './sideHeight.php';

require_once './update_cont/update.php';
require_once './process.php';

//$user_Ref = $_SESSION['user']['user_ref'];
$accHistory = mysqli_query($conn, "SELECT * FROM acc_history WHERE user_ref='$user_Ref' ORDER BY id DESC");

$reg_info = mysqli_query($conn, "SELECT * FROM users WHERE reg_Ref='$user_Ref'");
$fetchReg  = mysqli_fetch_assoc($reg_info);

//account balance query
// $balance = mysqli_query($conn, "SELECT SUM(amt) AS total FROM acc_history WHERE user_ref='$user_Ref' AND tran_status='APPROVED'");
// $fetchBal = mysqli_fetch_assoc($balance);

$balance = mysqli_query($conn, "SELECT * FROM real_acc WHERE user_ref='$user_Ref'");
$fetchBal = mysqli_fetch_assoc($balance);

//fetched from banking table
$sqlFetch = mysqli_query($conn, "SELECT * FROM OnBanking where user_ref='$user_Ref'");
if ($sqlFetch) {
    $row = mysqli_fetch_array($sqlFetch);
}
?>

<div class="column-large" id="col-large">
   
    <div class="general-settings-container">
        <div class="setting-container">
            <ul class="settings">
                <li><a href="#" class="tabs active" data-info="#change_pass">Transaction Pin</a></li>
                <li><a href="#" data-info="#forget_pass">Update Pin</a></li>
                <li><a href="?forgot_secret" data-info="#forget_secret">Remove Transaction Pin</a></li>
                <li><a href="?disable" data-info="#reset_secret">Login Auth</a></li>
            </ul>   
        </div>

        <!-- add pin -->
        <form action="" method="post" enctype="multipart/form" autocomplete="off" id="change_pass" class="content active">
            <input type="hidden" name="fPin" id="" value="<?=$user_Ref?>">
            <input type="password" name="pin" id="pass4" onkeyup="limit(this)" onkeydown="limit(this)"   class="form-control form-control-sm mt-3" placeholder="Enter Transaction Pin(4 digits)" onkeypress="return (event.charCode != 8 && event.charCode == 0 || (event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))">
            <span class="error-input"><?=$pin_er?></span>
            <br>
            <div class="check-container" style="margin-top: -20px;">
                <label for="" >
                <input type="checkbox" name="" onclick="functionShowPin()">
                    Show Password
                </label>   
            </div>
            <input type="password" name="confirm_pin" onkeydown="limit(this)" onkeyup="limit(this)" class="form-control form-control-sm mt-3" placeholder="Confirm Pin" onkeypress="return (event.charCode != 8 && event.char == 0 || (event.charCode == 46 ||(event.charCode >= 48 && event.charCode <= 57)))">
            <span class="error-input"><?=$comPin_er?></span>
            <button type="submit" name="submit_pin" class="btn btn-danger w-50 mt-3">Update</button>
            <a href="./settings" class="cancel-secret">cancel</a>
        </form>

         <!-- Update transaction Pin -->
         <form action="" method="post" enctype="multipart/form" autocomplete="off" class="content" id="forget_pass">
            <span class="text-danger d-block"><?=$status3?></span>
            <input type="hidden" name="cPin" id="" value="<?=$user_Ref?>">
            <input type="password" name="old_pin" id="pass3" onkeyup="limit(this)" onkeydown="limit(this)"   class="form-control form-control-sm mt-3" placeholder="Enter Old Pin(4 digits)" onkeypress="return (event.charCode != 8 && event.charCode == 0 || (event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))">
            <span class="error-input"><?=$old_pin_er?></span>
            <div class="check-container" style="margin-top: 5px; text-align: left">
                <label for="" >
                <input type="checkbox" name="" onclick="functionShowPin()">
                    Show Password
                </label>   
            </div>
            <input type="password" name="new_pin" id="pass" onkeyup="limit(this)" onkeydown="limit(this)"   class="form-control form-control-sm mt-3" placeholder="Enter New Pin(4 digits)" onkeypress="return (event.charCode != 8 && event.charCode == 0 || (event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))">
            <span class="error-input"><?=$new_pin_er?></span>
            <br>
            <input type="password" name="conf_pin" onkeydown="limit(this)" onkeyup="limit(this)" class="form-control form-control-sm mt-3" placeholder="Confirm Pin" onkeypress="return (event.charCode != 8 && event.char == 0 || (event.charCode == 46 ||(event.charCode >= 48 && event.charCode <= 57)))">
            <span class="error-input"><?=$com_pin_er?></span>
            <button type="submit" name="change_pin" class="btn btn-danger w-50 mt-3">Update</button>
            <a href="./settings" class="cancel-secret">cancel</a>
            <script>
                function limit(element) {
                    let input_length = 4;
                    if (element.value.length > input_length){
                        element.value = element.value.substr(0,input_length)
                    }
                }
            </script>
        </form>

        <!--  remove Pin -->
        <form action="" method="post" enctype="multipart/form" autocomplete="off" id="forget_secret" class="content remove">
            <input type="hidden" name="removePin" id="" value="<?=$user_Ref?>">
            <div class="card" >
                <div class="card-body bg-info">
                    <p class="fs-5 text-white">Are you Sure?</p>
                    <button type="submit" name="yes" class="btn">YES</button>
                    <a href="./tran_pin" class="cancel-secret">NO</a>
                </div>
            </div>
        </form>
      
        <!-- Auth -->
            <form action="" method="post" enctype="multipart/form" autocomplete="off" id="reset_secret" class="content auth">
                <input type="hidden" name="enable_dis" id="" value="<?= $user_Ref?>">
                <div class="card" style="width: 18em">
                    <div class="" >
                        <?php 
                            $sql = mysqli_query($conn, "SELECT * FROM otp where user_ref='$user_Ref'");
                            $sqlRowFetch = mysqli_fetch_assoc($sql);
                            if($sqlRowFetch['status'] == 'YES') {?>
                            <button type="submit" name="enable" class="btn btn-sm btn-danger w-25 deactivate" style="display: block">Deactivate</button>
                        <?php }else { ?>
                            <button type="submit" name="enable" class="btn btn-sm btn-danger w-25 ">Activate</button>
                        <?php } ?>
                    </div>
                </div>
            </form>
      
    </div>
</div>
</div>


<script>

</script>


<!-- sweetalertw pop through onclick -->
<script>
   
    function limit(element) {
        let input_length = 4;
        if (element.value.length > input_length){
            element.value = element.value.substr(0,input_length)
        }
    }
    function statement() {
        let timerInterval
        Swal.fire({
            title: 'Your request is processing..',
            html: 'Preparing statements <b></b>.',
            timer: 4000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                }, 150)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log('I was closed by the timer')
                Swal.fire(
                    'Statements completed. Kindly check your email for printed copy',
                )
            }
        })

    }

    function card() {
        Swal.fire({
            title: 'Do you want to Request a Card?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: `No`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Swal.fire('Your card request has been posted!', '', 'success')
            } else if (result.isDenied) {
                Swal.fire('Your card request has been denied!', '', 'info')
            }
        })
    }
</script>
<style>
    .swal2-popup {
        width: 250px !important;
        height: 250px !important;
        font-size: 12px !important;
        font-family: Georgia, serif;
    }

    .swal2-button {
        padding: 7px 19px;
        border-radius: 2px;
        background-color: #4962B3;
        font-size: 12px;
        border: 1px solid #3e549a;
        text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.3);
    }
</style>
<?php require './includes/new_footer.php'; ?>