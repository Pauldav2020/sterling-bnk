<?php
require './includes/new_header.php';



//user_Ref = 'REG-8236188';
// <span style="background-color: green; font-weight: bold; width: 50px; height: 50px; border-radius:100%"</span>
// $_SESSION['time'] = time();
// $_SESSION['approve']  = $_SESSION['time']+ (02 * 60);

$accHistory = mysqli_query($conn, "SELECT * FROM acc_history WHERE user_ref='$user_Ref' ORDER BY id DESC");
$rowHistory = mysqli_fetch_array($accHistory);
// $accFetch = $rowHistory['beneficiary_acc'];

$reg_info = mysqli_query($conn, "SELECT * FROM users WHERE reg_Ref='$user_Ref'");
$fetchReg  = mysqli_fetch_array($reg_info);

//account balance query
// $balance = mysqli_query($conn, "SELECT SUM(amt) AS total FROM acc_history WHERE user_ref='$user_Ref' AND tran_status='APPROVED'");
// $fetchBal = mysqli_fetch_assoc($balance);

$balance = mysqli_query($conn, "SELECT * FROM real_acc WHERE user_ref='$user_Ref'");
$fetchBal = mysqli_fetch_assoc($balance);


$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
$result = $conn->query("SELECT * FROM acc_history WHERE user_ref='$user_Ref' ORDER BY id DESC LIMIT $start, $limit");
// $customers = $result->fetch_all(MYSQLI_ASSOC);
// $result2 = $conn->query("SELECT * FROM acc_history WHERE beneficiary_acc='$accFetch' ORDER BY id DESC LIMIT $start, $limit");
// $customers2 = $result2->fetch_all(MYSQLI_ASSOC);

$result1 = $conn->query("SELECT count(id) AS id FROM acc_history WHERE user_ref='$user_Ref'");
$custCount = $result1->fetch_assoc();


//$total = $custCount[0]['id'];
//$pages = ceil($total / $limit);

$Previous = $page - 1;
$Next = $page + 1;

// total credit
$checkSql = mysqli_query($conn, "SELECT SUM(amt) AS total FROM acc_history WHERE user_ref='$user_Ref' AND Tran_Typ='Credit'");
$fetchTotalCredit = mysqli_fetch_assoc($checkSql);

// total Debit
$checkDeb = mysqli_query($conn, "SELECT SUM(amt) AS total FROM acc_history WHERE user_ref='$user_Ref' AND Tran_Typ='Debit'");
$fetchTotalDebit = mysqli_fetch_assoc($checkDeb);

function countFunction($conn, $user_Ref)
{
    $sql = mysqli_query($conn, "SELECT * FROM acc_history WHERE user_ref='$user_Ref'");
    $result = mysqli_num_rows($sql);
    return $result;
}

function get4DAcNumber($ccNum)
{
    return str_replace(range(0, 9), "x", substr($ccNum, 0, -4)) .  substr($ccNum, -4);
}

$file_er = '';
if (isset($_POST['submitFile'])) {
    $uploads = "uploads/";
    $target_dir = $uploads . basename($_FILES['fileName']['name']);
    $target_file = strtolower(pathinfo($target_dir, PATHINFO_EXTENSION));
    $uploadOk = 1;


    if ($_FILES['fileName']['size'] > 5000000) {
        echo   "file is too large";
        $uploadOk = 0;
    }
    if ($target_file != "jpg" && $target_file != "jpeg" && $target_file != "png" && $target_file != "gif" && $target_file != "gif") {
        echo "File is not support";
        $uploadOk = 0;
        var_dump($conn);
    }
    if ($uploadOk == 0) {
        echo "Image failed to upload";
        var_dump($conn);
    } else {
        if (move_uploaded_file($_FILES['fileName']['tmp_name'], $target_dir)) {
            $sql = mysqli_query($conn, "UPDATE OnBanking SET image='$target_dir' WHERE user_ref='$user_Ref'");
            if ($sql) {
                echo "<script>alert('profile has been uploaded');window.location.href='./dashboard'</script>";
            } else {
                echo "<script>alert('profile failed to upload');window.location.href='./dashboard'</script>";
            }
        }
    }
}

//currency svg
$currencyImg = '';
if ($fetchReg['currency'] === '$') {
    $currencyImg = '<img src="./dash-img/dollar.svg" alt="USD">';
} else if ($fetchReg['currency'] === "€") {
    $currencyImg = ' <img src="./dash-img/euro.svg" alt="euro">';
} else {
    $currencyImg = ' <img src="./dash-img/pound.svg" alt="pound">';
}

//currency svg
$currencyWord = '';
if ($fetchReg['currency'] === '$') {
    $currencyWord  = 'USD';
} else if ($fetchReg['currency'] === "€") {
    $currencyWord  = 'EUR';
} else {
    $currencyWord  = 'GBP';
}


?>



<div class="account-info">
    <div class="grid-container">
        <div class="col">
            <div class="badge">Checking Account</div>
            <div class="container">
                <?php
                echo $currencyImg;
                ?>
                <div>
                    <h5><?= get4DAcNumber($fetchReg['Check_Acc_No']) ?></h5>
                    <p>Bal: <?= number_format($fetchBal['cBal'], 2) ?></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="badge">Saving Account</div>
            <div class="container">
                <?php
                echo $currencyImg;
                ?>
                <div>
                    <h5><?= get4DAcNumber($fetchReg['Sav_Acc_No']) ?></h5>
                    <p>Bal: <?= number_format($fetchBal['sBal'], 2) ?></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="badge">Loan Account</div>
            <div class="container">
                <?php
                echo $currencyImg;
                ?>
                <div>
                    <h5>xxxxx000</h5>
                    <p>Bal: <?= number_format($fetchBal['loanBal'], 2) ?></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="badge">Account Track</div>
            <div>
                <h5>Cash in: <span class="in">
                        <?php
                        $totalCred = $fetchTotalCredit['total'];
                        if ($totalCred == 0) { ?>

                        <?php } else { ?>
                            <span class="amount">$<?= number_format($fetchTotalCredit['total'], 2) ?></span> <span class="percent">+15.5%</span></p>
                            <div class="progress-in"></div>
                        <?php }
                        ?>
                    </span></h5>
                <h5 class="out">Cash out: <span>

                        <?php
                        $totalDeb = $fetchTotalCredit['total'];
                        if ($totalDeb == 0) { ?>
                        <?php } else { ?>
                            <span class="amount">$<?= number_format($fetchTotalDebit['total'], 2) ?></span> <span class="percent">-5.5%</span></p>
                            <div class="container-bar">
                                <div class="progress-out"></div>
                            </div>
                        <?php }
                        ?>
                    </span></h5>
            </div>
        </div>
        <div class="col large">
            <div class="badge">Transact</div>
            <div class="container">
                <img src="./dash-img/payment.svg" alt="">
                <h5> make a bank transfer</h5>
            </div>
            <div>
                <hr>
                <button><a href="transfer" style="text-decoration: none; color: white">bank transfer </a></button>
            </div>
        </div>
        <div class="col large">
            <div class="badge">Account Statements</div>
            <div>
                <div class="container">
                    <img src="./dash-img/wallet.svg" alt="">
                    <h5> view bank account statement</h5>
                </div>
                <hr>
                <button><a href="acc_history" style="text-decoration: none; color: white">view statement</a></button>
            </div>
        </div>
        <div class="col large message">
            <div class="badge">Messages</div>

            <div class="messages">
                <!-- <div class="container" style="margin-right: -120px">
                    <img src="./dash-img/message.svg" alt="">
                </div> -->
                <ul class="first">
                    <h5>Messages</h5>
                    <div class="sms">
                        <img src="./dash-img/message.svg" alt="">
                        <li>
                            (<span class="showNotify"></span>) New Message(s)
                        </li>
                        <div class="notify"><span class="showNotify"></span></div>
                    </div>
                </ul>
                <ul class="second">
                    <h5>Last Login</h5>
                    <li><?= $last_login ?></li>
                </ul>
            </div>
        </div>
        <div class="col wallet">
            <div class="heading">
                <div class="count">
                    <span class="name">Wallet</span>
                    <span class="list">Cards | <span>1 out of 2</span></span>
                </div>
                <div class="btns">
                    <button class="left" disabled>
                        <span>
                            < </span>
                    </button>
                    <button class="right">
                        <span>></span>
                    </button>
                </div>
            </div>
            <div class="cards-container">
                <div class="card-col visa">
                    <div class="cards">
                        <img src="./dash-img/card.jpg" alt="">
                        <div class="divider"></div>
                        <div class="balances">
                            <ul>

                                <li>
                                    <p>Balance</p>
                                    <p><?=number_format($fetchBal['visaBal'],2)?></p>
                                </li>
                                <li>
                                    <p>Currency</p>
                                    <p><?=$currencyWord?></p>
                                </li>
                                <div class="activate">
                                    <p>Deactivate Card</p>
                                    <div class="container switcher">
                                        <div class="switch"></div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-col master">
                    <div class="cards">
                        <img src="./dash-img/card.jpg" alt="">
                        <div class="divider"></div>
                        <div class="balances">
                            <ul>

                                <li>
                                    <p>Balance</p>
                                    <p><?=number_format($fetchBal['creditBal'],2)?></p>
                                </li>
                                <li>
                                    <p>Currency</p>
                                    <p>US Dollar</p>
                                </li>
                                <div class="activate">
                                    <p>Deactivate Card</p>
                                    <div class="container switcher">
                                        <div class="switch"></div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col chart">
            <div class="hist-container">
                <h4>Transaction Details</h4>
                <div class="acc-info">

                    <table>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <th>
                                    <?php if ($row['Tran_Typ'] == "Debit") { ?>
                                        <span style="background-color: rgb(250, 161, 176);; font-weight: bold; height: 20px; width: 20px; border-radius:100%; text-align: center; color: red; padding: 0px 3px"><?= $row['currency'] ?></span> <span style="font-weight: normal;" class="credit">Debited From A/C <?= $row['Rec_Acc']; ?></span>
                                    <?php
                                        $row['beneficiary_name'];
                                    } else { ?>
                                        <span style="background-color: greenyellow; font-weight: bold; height: 20px; width: 20px; border-radius:100%; text-align: center; color: rgb(15, 235, 15); padding:0px 3px"><?= $row['currency'] ?></span> <span style="font-weight: normal;" class="credit">Credited to A/C <?= $row['Rec_Acc']; ?></span>
                                    <?php }
                                    ?>
                                    <p><?= $row['hist_date'] ?></p>
                                </th>
                                <td>
                                    <span class="amount"><?= $row['currency'] . " " . number_format($row['amt'], 2) ?></span>
                                </td>
                            </tr>
                        <?php endwhile; ?>

                        <tr class="">
                            <th colspan="9">

                            </th>
                        </tr>
                    </table>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li>
                            <?php
                            if ($Previous == 0) { ?>
                                <span class="disabled">Previous</span>
                            <?php } else { ?>
                                <a href="dashboard?page=<?= $Previous; ?>" aria-label="Previous">
                                    <span aria-hidden="true" class="text-danger">&laquo; Previous</span>
                                </a>
                            <?php } ?>
                            <a href="dashboard?page=<?= $Next; ?>" aria-label="Next">
                                <span aria-hidden="true" class="text-danger m-5">Next &raquo;</span>
                            </a>

                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col chart">
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Year', 'Cash Credited', 'Cash Debited'],
                        ['January', 1000, 400],
                        ['March', 1170, 460],
                        ['July', 660, 1120],
                        ['December', 1030, 540]
                    ]);

                    var options = {
                        title: 'Cash Flow',
                        hAxis: {
                            title: '',
                            titleTextStyle: {
                                color: '#333'
                            }
                        },
                        vAxis: {
                            minValue: 0
                        }
                    };

                    var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
                    chart.draw(data, options);
                }
            </script>
            <div id="chart_div" style="width: 100%; overflow: auto; height: auto; background: none ">
                <iframe src="https://www.mortgagecalculator.net/embeddable/v2/?size=1" width="100%" frameborder="0" scrolling="yes" height="300"></iframe>
            </div>
        </div>
        <div class="col mortgage">
            <iframe src="https://www.mortgagecalculator.net/embeddable/v2/?size=1" width="100%" frameborder="0" scrolling="yes" height="300"></iframe>
        </div>
    </div>
</div>

<?php
require_once './includes/new_footer.php'
?>