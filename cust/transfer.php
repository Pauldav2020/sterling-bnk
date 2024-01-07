<?php
require_once './config/config.php';

require_once './includes/new_header.php';
include './sideHeight.php';

//$userRef = $_SESSION['user']['user_ref'];
$sqlfetchResult = mysqli_query($conn, "SELECT * FROM users where reg_Ref='$user_Ref'");
$tran_row = mysqli_fetch_assoc($sqlfetchResult);

// Current balance query
$checkBal = mysqli_query($conn, "SELECT * FROM real_acc WHERE user_ref='$user_Ref'");
$fetchBal = mysqli_fetch_assoc($checkBal);

?>
<div class="column-large" id="col-large">
    <div class="transfer">
        <!-- <h5>Transaction</h5> -->
        <ul class="transactions">
            <li><a href="#" id="brookline-acc"
                    onclick="document.getElementById('brookline').style.display='block'">Other Starling Account <i
                        class="fa-solid fa-angles-right"></i></a></li>
            <li><a href="#" id="other" onclick="document.getElementById('other-bank').style.display='block'">Transfer To
                    Other Bank <i class="fa-solid fa-angles-right"></i></a></li>
            <li onclick="document.getElementById('show-saved').style.display='block'"><a href="#" id="saved-acc">To
                    Saved Beneficiary <i class="fa-solid fa-angles-right"></i></a></li>
            <li><a href="#" id="print">Print Transaction Reciept <i class="fa-solid fa-angles-right"></i></a></li>
        </ul>

    </div>
    <div class="saved-beneficiaries" id="show-saved" style="display:none;">
        <?php require_once './beneficiaries.php'; ?>
    </div>
    <div class="form-list-inputs">
        <div class="form-container">
            <div class="brookline-acc" id="brookline">
                <form action="" class="brook-content brook-animate" method="POST">
                    <span class="close-btn"
                        onclick="document.getElementById('brookline').style.display='none'">&times</span>
                    <select name="debit" id="AccounSelect" class="selected" required>
                        <option value="" selected>Select account to debit</option>
                        <option value="<?= $tran_row['Check_Acc_No'] ?>">
                            <?= $tran_row['Check_Acc_No'] . " - " . $tran_row['currency'] . number_format($fetchBal['cBal'], 2) ?>
                        </option>
                        <option value="<?= $tran_row['Sav_Acc_No'] ?>">
                            <?= $tran_row['Sav_Acc_No'] . " - " . $tran_row['currency'] . number_format($fetchBal['sBal'], 2) ?>
                        </option>
                    </select>
                    <span id="fetchResult" class="error-input"></span>
                    <br>
                    <input type="text" name="accoun" id="accNumber" placeholder="Enter Account Number"
                        onkeydown="limit(this)"
                        onkeypress="return (event.charCode !=8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <= 57))">
                    <script>

                    </script>
                    <span id="fetchResult" class="error-input"></span>
                    <br>
                    <span id="txt" class="error-input"></span>
                    <div class="process">
                        <div class="text-center" id="spiner" style="display: none;">
                            <div class="spinner-border" role="status"></div>
                        </div>
                        <span class="error-input" id="error"></span>
                    </div>
                    <!-- </div> -->
                </form>
            </div>

            <div class="pop-container" id="fetchAccount">
                <div id="showConfirm" class="show-confirm" style="z-index: 99;"></div>
                <form action="" method="post" class="form-content">
                    <div class="container1">
                        <input type="hidden" name="" id="id" value="<?= $user_Ref ?>">
                        <input type="hidden" class="form-control" id="sender_Acc">
                        <input type="text" class="form-control" id="acc_Num">
                        <input type="text" class="form-control" id="name">
                        <input type="text" class="form-control" id="type">
                        <input type="text" class="form-control" id="curt" readonly>
                        <input type="text" name="" id="amt" placeholder="Enter Amount" class="form-control">
                        <span class="error-input" id="amt_er"></span>
                        <br>
                        <div class="saved-ben-click">
                            <label for="">
                                Save Beneficiary
                                <input type="checkbox" name="savedBen" id="myCheck" type="button" value="submit">
                            </label>
                        </div>
                        <?php
                        $sql = mysqli_query($conn, "SELECT * FROM tranpin WHERE user_ref='$user_Ref'");
                        if (mysqli_num_rows($sql) > 0) { ?>
                        <div id="transfer">
                            <button id="pinSubmit" type="submit">Transfer</button>
                            <a href="transfer">Cancel</a>
                        </div>
                        <?php } else { ?>
                        <div id="transfer ">
                            <button id="same-bank" type="submit">Transfer</button>
                            <a href="transfer" id="cancel-same-bank">Cancel</a>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="text-center" id="spinnering" style="display: none;">
                        <div class="spinner-border" role="status">

                        </div>
                    </div>
                </form>
            </div>

            <div class="other-bank" id="other-bank">
                <div id="showResponse" style="z-index: 99;"></div>
                <form action="" method="post" class="form-content other-animate">
                    <?php
                    $sqlCheck = mysqli_query($conn, "SELECT * FROM users WHERE reg_Ref='$user_Ref'");
                    $tran_rows = mysqli_fetch_array($sqlCheck);
                    ?>
                    <select name="debit" id="AccToDebit" class="selected" required>
                        <option value="">Select Account</option>
                        <option value="<?php echo $tran_rows['Check_Acc_No'] ?>">
                            <?= $tran_rows['Check_Acc_No'] . " - " . $tran_row['currency'] . number_format($fetchBal['cBal'], 2) ?>
                        </option>
                        <option value="<?php echo $tran_rows['Sav_Acc_No'] ?>">
                            <?= $tran_rows['Sav_Acc_No'] . " - " . $tran_row['currency'] . number_format($fetchBal['sBal'], 2) ?>
                        </option>
                    </select>

                    <span class="d-block text-danger" style="color: red; display:block;" id="select_er"></span>
                    <input type="hidden" id="id" value="<?= $user_Ref ?>">
                    <input type="text" name="name" id="benName" placeholder="Enter Account Name">
                    <span class="error-input" id="benName_er"></span>
                    <input type="text" id="accNum" placeholder="Enter Account Number"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
                    <span class="error-input" id="benAcc_er"></span>
                    <input type="text" name="bank" id="bankName" placeholder="Enter Bank Name">
                    <span class="error-input" id="benBank_er"></span>
                    <input type="text" id="routing" placeholder="Enter Routing Number for local transfer"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
                    <span class="error-input" id="routing_er"></span>
                    <input type="text" name="swift" id="swift"
                        placeholder="Only enter swift for International transfer">
                    <span class="error-input" id="swift_er"></span>
                    <!-- <input type="text"  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" /> -->
                    <input type="text" id="amount" placeholder="Enter Amount"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))" />
                    <!-- <input type="number" name="amt" id="amount" placeholder="Enter Amount"> -->
                    <span class="error-input" id="amount_er"></span>
                    <div class="saved-click">
                        <input type="checkbox" name="savedBen" id="other-bank-ben" value="submit">
                        <label for="checkbox" class="">Save Beneficiary</label>
                    </div>

                    <div class="process2 w-75 d-flex mx-auto" id="process2-hide">
                        <?php
                        $sql = mysqli_query($conn, "SELECT * FROM tranpin WHERE user_ref='$user_Ref'");
                        if (mysqli_num_rows($sql) > 0) { ?>
                        <a href="transfer" class="cancel btn btn-sm btn-danger">Cancel</a>
                        <button type="submit" name="send" class="transafer btn btn-sm btn-primary"
                            id="pinSubmit_other">Send</button>
                        <?php } else { ?>
                        <a href="transfer" class="cancel btn btn-sm btn-danger" id="cancel-other-bank">Cancel</a>
                        <button type="submit" name="send" class="transafer btn btn-sm btn-primary"
                            id="sender2">Send</button>
                        <?php }
                        ?>

                    </div>
                    <div class="text-center" id="spinner3" style="display: none; color: red;">
                        <div class="spinner-border" role="status"></div>
                    </div>
                </form>
            </div>
            <div class="spinnerNew" id="spinner" style="display: none!important;">
                <div class="inner-spinNew">
                    <div class="spinner-container">
                        <div class="spinner1"></div>
                        <div class="count-form">
                            <span id="count_el">0%</span>
                        </div>
                        <div class="spinner2"></div>
                    </div>
                </div>
            </div>
            <div class="bill_form" id="biller" style="display: none!important;">
                <div class="inner-bill">
                    <span class="closetn2" onclick="window.location.reload()" id="close-Btn-d">&times</span>
                    <?php require_once './process/code_forms.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bouncer {
    display: flex;
    justify-content: space-around;
    align-items: flex-end;
    width: 100px;
    height: 100px;
}

.bouncer div {
    width: 20px;
    height: 20px;
    background: red;
    border-radius: 50%;
    animation: bouncer 0.5s cubic-bezier(.19, .57, .3, .98) infinite alternate;
}

@keyframes bouncer {
    from {
        transform: translateY(0)
    }

    to {
        transform: translateY(-100px)
    }
}

/* The bouncer div child is to apply single child bouncer */
.bouncer div:nth-child(2) {
    animation-delay: 0.1s;
    opacity: 0.8;
}

.bouncer div:nth-child(3) {
    animation-delay: 0.2s;
    opacity: 0.7;
}

.bouncer div:nth-child(4) {
    animation-delay: 0.3s;
    opacity: 0.6;
}

/* @media(min-width: 390px){
    .inner-spinNew{
      
   
    }
  } */
.spinnerNew {
    position: fixed;
    top: 0;
    left: 0;
    margin-bottom: 100px;
    width: 100%;
    height: 100%;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.3);
}

.inner-spinNew {
    position: absolute;
    top: 150px;
    left: 25%;
    width: 300px;
    height: 20%;
    margin: 60px 25px 0 -20px;
    padding: 50px 30px;
    background-color: #f9f9f1;

}

.count-form {
    position: absolute;
    top: 60px;
    left: 110px;
    background-color: #fff;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    text-align: center;
    z-index: 99;
}

#count_el {
    position: absolute;
    top: 30%;
    left: 0;
    right: 0;
    text-align: center;
    margin: 0 auto;
}

.spinnerNew .spinner1 {
    position: absolute;
    left: 100px;
    box-sizing: border-box;
    width: 100px;
    height: 100px;
    border: 10px solid transparent;
    border-top: 10px solid purple;
    border-radius: 50%;
    -webkit-animation: spiner linear infinite;
    animation: spiner 1.2s linear infinite;
}

@-webkit-keyframes spiner {
    0% {
        transform: rotate(0deg);
        border-width: 10px;
    }

    50% {
        transform: rotate(180deg);
        border-width: 1px;
    }

    100% {
        transform: rotate(360deg);
        border-width: 10px;
    }
}

@keyframes spiner {
    0% {
        transform: rotate(0deg);
        border-width: 10px;
    }

    50% {
        transform: rotate(180deg);
        border-width: 1px;
    }

    100% {
        transform: rotate(360deg);
        border-width: 10px;
    }
}

.spinnerNew .spinner2 {
    position: absolute;
    left: 100px;
    box-sizing: border-box;
    width: 100px;
    height: 100px;
    border: 10px solid transparent;
    border-bottom: 10px solid red;
    border-radius: 50%;
    -webkit-animation: spin2 linear infinite;
    animation: spin2 1.2s linear infinite;
}

@-webkit-keyframes spin2 {
    0% {
        transform: rotate(0deg);
        border-width: 1px;
    }

    50% {
        transform: rotate(180deg);
        border-width: 10px;
    }

    100% {
        transform: rotate(360deg);
        border-width: 1px;
    }
}

@keyframes spin2 {
    0% {
        transform: rotate(0deg);
        border-width: 1px;
    }

    50% {
        transform: rotate(180deg);
        border-width: 10px;
    }

    100% {
        transform: rotate(360deg);
        border-width: 1px;
    }
}

/* .spinner2{
    width: 100px;
    height: 100px;
    margin-top: -100px;;
    border:  4px solid transparent;
    border-bottom: 10px solid red;
    border-radius: 50%;
    -webkit-animation: spin2 linear infinite;
    animation: spin2 0.6s linear infinite;
  }
  @-webkit-keyframes spin2{
  from{transform: rotate(360deg)}
    to{transform: rotate(0deg)}
  }
  @keyframes spin2{
    from{transform: rotate(360deg)}
    to{transform: rotate(0deg)}
  } */

.swal2-popup {
    width: 300px !important;
    height: 300px !important;
    font-size: 15px !important;
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

<!-- saved beneficiary display none -->
<script>
let popShow = document.getElementById("fetchAccount")
window.onclick = function(event) {
    if (event.target == popShow) {
        popShow.style.display = "none";
        window.location.reload();
    }
}

function limit(e) {
    input_limit = 10;
    if (e.value.length > input_limit) {
        e.value = e.value.substr(0, input_limit);
    }
}

let container = document.getElementById("bank-back");
window.onclick = function(event) {
    if (event.target == container) {
        container.style.display = "none";
    }
}
</script>
<!-- saved beneficiaries ends here -->

<!-- sweetalertw pop through onclick -->
<script>
// 

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

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="./controller/js/ajax.js"></script>
<script src="./js/transfer.js"></script>
<?php include './includes/new_footer.php'?>