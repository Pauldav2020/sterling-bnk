<?php
require './includes/new_header.php';
//require './includes/reg-header.php';
include './sideHeight.php';

require_once './update_cont/update.php';


//$user_Ref = $_SESSION['user']['user_ref'];
$accHistory = mysqli_query($conn, "SELECT * FROM acc_history WHERE user_ref='$user_Ref' ORDER BY id DESC");

$reg_info = mysqli_query($conn, "SELECT * FROM users WHERE reg_Ref='$user_Ref'");
$fetchReg  = mysqli_fetch_assoc($reg_info);

//account balance query
// $balance = mysqli_query($conn, "SELECT SUM(amt) AS total FROM acc_history WHERE user_ref='$user_Ref' AND tran_status='APPROVED'");
// $fetchBal = mysqli_fetch_assoc($balance);

$balance = mysqli_query($conn, "SELECT * FROM real_acc WHERE user_ref='$user_Ref'");
$fetchBal = mysqli_fetch_assoc($balance);

?>
<div class="column-large" id="col-large">
    <div class="general-settings-container">
        <div class="setting-container">
            <ul class="settings">
                <li><a href="#" class="tabs active" data-info="#change_pass">Change Password</a></li>
                <li><a href="#" data-info="#forget_pass">Forgot Password</a></li>
                <li><a href="?forgot_secret" data-info="#forget_secret">Forgot Secret Answer</a></li>
                <li><a href="?reset_secret" data-info="#reset_secret">Reset Secret Answer</a></li>
            </ul>
        </div>
        <form action="" method="post" enctype="multipart/form" autocomplete="off" class="content" id="reset_secret">
            <input type="hidden" name="reset_sec" id="" value="<?= $user_Ref ?>">
            <div class="card">
                <div class="card-body bg-info">
                    <label for="" class="text-white">Question</label>
                    <input type="text" name="question_reset" id="" class="form-control form-control-sm " placeholder=" ">
                    <span class="text-danger d-block"><?= $q_reset_er ?></span>
                    <label for="" class="text-white">Answer</label>
                    <input type="text" name="answer_reset" id="" class="form-control form-control-sm ">
                    <span class="text-danger d-block"><?= $a_reset_er ?></span>
                    <button type="submit" name="reset" class="btn btn-sm btn-danger w-50 mt-2">Update</button>
                    <a href="./settings" class="cancel-secret">Cancel</a>
                </div>
            </div>
        </form>

        <?php
        $sqlFetch = mysqli_query($conn, "SELECT * FROM OnBanking where user_ref='$user_Ref'");
        if ($sqlFetch) {
            $row = mysqli_fetch_array($sqlFetch);
        }
        ?>

        <form action="" method="post" enctype="multipart/form" autocomplete="off" class="content" id="forget_secret">
            <input type="hidden" name="forgot_sec" id="" value="<?= $user_Ref ?>">
            <div class="card">
                <div class="card-body bg-info">
                    <label for="" class="text-white">Question</label>
                    <input type="text" name="" id="" value="<?= $row['question'] ?>" disabled readonly>
                    <label for="" class="text-white">Answer</label>
                    <input type="text" name="" id="" value="<?= $row['answer'] ?>" readonly>
                    <a href="./settings" class="cancel-secret">Cancel</a>
                </div>
            </div>
        </form>

        <?php
        $questionSql = mysqli_query($conn, "SELECT * FROM OnBanking WHERE user_ref='$user_Ref'");
        $rowSql = mysqli_fetch_assoc($questionSql);
        $rowFetch = $rowSql['question'];
        $rowAnswer = $rowSql['answer']; { ?>
            <form action="" method="post" enctype="multipart/form" autocomplete="off" class="content" id="forget_pass">
                <span class="text-danger d-block"><?= $status2 ?></span>
                <input type="hidden" name="fPass" id="" value="<?= $user_Ref ?>">
                <input type="hidden" name="DatabaseAns" id="" value="<?= $rowAnswer ?>">
                <label for="">Secret Question</label>
                <input type="text" name="question" id="" value="<?= $rowFetch ?>" class="form-control form-control-sm mt-3" readonly>
                <label for="">Secret Answer</label>
                <input type="text" name="answer" id="" placeholder="Secret Answer" class="form-control form-control-sm mt-3">
                <span class="text-danger d-block"><?= $answer_er ?></span>
                <label for="">Login Username</label>
                <input type="username" name="username" class="form-control form-control-sm mt-3" placeholder="Enter Username">
                <span class="d-block text-danger"><?= $user_er ?></span>
                <label for="">New Password</label>
                <input type="password" name="password" id="pass1" class="form-control form-control-sm mt-3" placeholder="Enter New Password">
                <span class="d-block text-danger"><?= $fPass_er ?></span>
                <div class="check-container">
                    <span>Show Password</span>
                    <input type="checkbox" name="" onclick="functionShow()">
                </div>
                <label for="">Confirm Password</label>
                <input type="password" name="f-confirm" id="" class="form-control form-control-sm mt-3" placeholder="Confirm New Password">
                <span class="d-block text-danger"><?= $cForgot_er ?></span>
                <button type="submit" name="forgot_pass" class="btn btn-danger w-50 mt-3">Update</button>
                <a href="./settings" class="cancel-secret">cancel</a>
            </form>

            <form action="" method="post" enctype="multipart/form" autocomplete="off" class="content active" id="change_pass">
                <span class="text-danger d-block"><?= $status2 ?></span>
                <input type="hidden" name="user" id="" value="<?= $user_Ref ?>">
                <input type="password" name="old_password" id="pass2" class="form-control form-control-sm mt-3" placeholder="Enter Old Password">
                <span class="d-block text-danger"><?= $old_err ?></span>
                <br>
                <div class="check-container" style="margin-top: -20px;">
                    <label for="">
                        <input type="checkbox" name="" onclick="functionShow()">
                        Show Password
                    </label>
                </div>
                <input type="password" name="new_password" id="" class="form-control form-control-sm mt-3" placeholder="Enter New Password">
                <span class="d-block text-danger"><?= $new_err ?></span>
                <input type="password" name="confirm" id="" class="form-control form-control-sm mt-3" placeholder="Confirm New Password">
                <span class="d-block text-danger"><?= $confirm_err ?></span>
                <button type="submit" name="change_pass" class="btn btn-danger w-50 mt-3">Update</button>
                <a href="./settings" class="cancel-secret">cancel</a>
            </form>
        <?php } ?>
    </div>
</div>
</div>


<script>

</script>


<!-- sweetalertw pop through onclick -->
<script>
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