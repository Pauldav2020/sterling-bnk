<?php
require_once './config/config.php';
require_once './includes/reg-header.php';
require_once './process.php';



$sn = 1;

//search query
if (isset($_POST["search"])) {
    $search = $_POST["users"];
} else {
    $search = "";
}
//admin id
$admin_Ref = 'REG-1027021';

//fetch notifications
$Notificaton = mysqli_query($conn, "SELECT * FROM chats WHERE NOT outgoing_msg_id='$admin_Ref' AND status='1'");


//ADD BACKDATED HISTORY
if(isset($_POST["yes"])){
    $backDateUser = $_POST["backDate"];
    $sqlAcc = mysqli_query($conn, "SELECT * FROM users WHERE reg_Ref='$backDateUser'");
    if(mysqli_num_rows($sqlAcc)> 0){
        $fetch = mysqli_fetch_array($sqlAcc);
        $rec_acc = $fetch['Check_Acc_No'];
        $savings = $fetch['Sav_Acc_No'];
        $tranId1 = "SWT".rand(111111,999999);
        $tranId2 = "SWT".rand(111111,999999);
        $tranId3 = "SWT".rand(111111,999999);
        $tranId4 = "SWT".rand(111111,999999);
        $tranId5 = "SWT".rand(111111,999999);
        $tranId6 = "SWT".rand(111111,999999);
        $tranId7 = "SWT".rand(111111,999999);
        $tranId8 = "SWT".rand(111111,999999);
        $tranId9 = "SWT".rand(111111,999999);
        $tranId10 = "SWT".rand(111111,999999);
        $tranId11 = "SWT".rand(111111,999999);
        $tranId12 = "SWT".rand(111111,999999);
        $tranId13 = "SWT".rand(111111,999999);

        // new 2020
        $tranId14 = "SWT".rand(111111,999999);
        $tranId15 = "SWT".rand(111111,999999);
        $tranId16 = "SWT".rand(111111,999999);
        $tranId17 = "SWT".rand(111111,999999);

        // 2021
        $tranId18 = "SWT".rand(111111,999999);
        $tranId19 = "SWT".rand(111111,999999);
        $tranId20 = "SWT".rand(111111,999999);
        $tranId21 = "SWT".rand(111111,999999);

        // 2022 savings account reference
        $tranId22 = "SWT".rand(111111,999999);
        $tranId23 = "SWT".rand(111111,999999);
        $tranId24 = "SWT".rand(111111,999999);
        $tranId25 = "SWT".rand(111111,999999);
        $tranId26 = "SWT".rand(111111,999999);
        $tranId27 = "SWT".rand(111111,999999);

        $date1 = "2016-01-12 12:21:28";
        $date2 = "2016-01-21 10:11:02";
        $date3 = "2016-02-10 08:41:30";
        $date4 = "2017-03-02 12:01:03";
        $date5 = "2017-03-08 13:09:10";
        $date6 = "2017-03-22 12:11:49";
        $date7 = "2017-03-28 10:14:07";
        $date8 = "2018-11-19 14:35:46";
        $date9 = "2019-04-16 09:49:00";
        $date10 = "2019-04-23 11:03:10";
        $date11 = "2019-05-02 14:09:15";
        $date12 = "2019-05-13 13:19:20";
        $date13 = "2020-01-21 15:01:18";

        // addedd 2020
        $date14 = "2020-02-10 09:12:09";
        $date15 = "2020-02-20 13:01:11";
        $date16 = "2020-05-04 11:04:15";
        $date17 = "2020-08-27 08:14:05";

        // 2021
        $date18 = "2021-03-09 14:02:20";
        $date19 = "2021-03-17 15:11:01";
        $date20 = "2021-07-29 12:08:15";
        $date21 = "2021-10-04 09:10:08";

        // 2022 savings credit date
        $date22 = "2022-01-13 08:12:00";
        $date23 = "2022-03-22 10:01:21";
        $date24 = "2022-05-02 11:08:05";
        $date25 = "2022-09-14 09:00:05";
        $date26 = "2022-09-19 15:20:15";
        $date27 = "2022-10-06 07:09:25";
        
        $debit = "Debit";

        $credit = "Credit";

        $amtCred1 = 10000650;
        $amtCred2 = 3000000;
        $amtCred3 = 5000000;
        $amtCred4 = 630000;
        $amtCred5 = 153000;
        $amtCred6 = 53000;
        $amtCred7 = 203000;
        $amtCred8 = 800000;

        $amtDeb1 = 1200000;
        $amtDeb2 = 620000;
        $amtDeb3 = 3050000;
        $amtDeb4 = 9620456;
        $amtDeb5 = 2204056;

        // new 2020
        $amtDeb6 = 50000;
        $amtDeb7 = 30000;
        $amtDeb8 = 45300;
        $amtDeb9 = 120000;

        // 2021
        $amtCred9 = 400000;
        $amtDeb10 = 20000;
        $amtDeb11 = 80000;
        $amtDeb12 = 150000;

        // 2022 savings
        $savCred1 = 200000;
        $savCred2 = 200000;
        $savCred3 = 50000;
        $savCred4 = 100000;
        $savCred5 = 150000;
        // 2022 debit
        $amtDeb13 = 100000;


        $ben_bank = "Bank";
        $ben_name = "Name";
        $ben_acc = "0000";
        $tran_status = "APPROVED";
        $curr = "$";

        $sql  = mysqli_query($conn,"INSERT INTO acc_history(user_ref,tran_Ref,beneficiary_name,beneficiary_acc,beneficiary_bank,currency,amt,Tran_Typ,tran_status,Rec_Acc,hist_date)
            VALUES('$backDateUser','$tranId1','$ben_name','$ben_acc','$ben_bank','$curr','$amtCred1','$credit','$tran_status','$rec_acc','$date1'),
            ('$backDateUser','$tranId2','$ben_name','$ben_acc','$ben_bank','$curr','$amtCred2','$credit','$tran_status','$rec_acc','$date2'),
            ('$backDateUser','$tranId3','$ben_name','$ben_acc','$ben_bank','$curr','$amtDeb3','$debit','$tran_status','$rec_acc','$date3'),
            ('$backDateUser','$tranId4','$ben_name','$ben_acc','$ben_bank','$curr','$amtDeb1','$debit','$tran_status','$rec_acc','$date4'),
            ('$backDateUser','$tranId5','$ben_name','$ben_acc','$ben_bank','$curr','$amtCred3','$credit','$tran_status','$rec_acc','$date5'),
            ('$backDateUser','$tranId6','$ben_name','$ben_acc','$ben_bank','$curr','$amtCred5','$credit','$tran_status','$rec_acc','$date6'),
            ('$backDateUser','$tranId7','$ben_name','$ben_acc','$ben_bank','$curr','$amtCred4','$credit','$tran_status','$rec_acc','$date7'),
            ('$backDateUser','$tranId8','$ben_name','$ben_acc','$ben_bank','$curr','$amtDeb5','$debit','$tran_status','$rec_acc','$date8'),
            ('$backDateUser','$tranId9','$ben_name','$ben_acc','$ben_bank','$curr','$amtDeb4','$debit','$tran_status','$rec_acc','$date9'),
            ('$backDateUser','$tranId10','$ben_name','$ben_acc','$ben_bank','$curr','$amtCred6','$credit','$tran_status','$rec_acc','$date10'),
            ('$backDateUser','$tranId11','$ben_name','$ben_acc','$ben_bank','$curr','$amtCred7','$credit','$tran_status','$rec_acc','$date11'),
            ('$backDateUser','$tranId12','$ben_name','$ben_acc','$ben_bank','$curr','$amtDeb2','$debit','$tran_status','$rec_acc','$date12'),
            ('$backDateUser','$tranId13','$ben_name','$ben_acc','$ben_bank','$curr','$amtCred8','$credit','$tran_status','$rec_acc','$date13'),
            ('$backDateUser','$tranId14','$ben_name','$ben_acc','$ben_bank','$curr','$amtDeb6','$debit','$tran_status','$rec_acc','$date14'),
            ('$backDateUser','$tranId15','$ben_name','$ben_acc','$ben_bank','$curr','$amtDeb7','$debit','$tran_status','$rec_acc','$date15'),
            ('$backDateUser','$tranId16','$ben_name','$ben_acc','$ben_bank','$curr','$amtDeb8','$debit','$tran_status','$rec_acc','$date16'),
            ('$backDateUser','$tranId17','$ben_name','$ben_acc','$ben_bank','$curr','$amtDeb9','$debit','$tran_status','$rec_acc','$date17'),
            ('$backDateUser','$tranId18','$ben_name','$ben_acc','$ben_bank','$curr','$amtCred9','$credit','$tran_status','$rec_acc','$date18'),
            ('$backDateUser','$tranId19','$ben_name','$ben_acc','$ben_bank','$curr','$amtDeb10','$debit','$tran_status','$rec_acc','$date19'),
            ('$backDateUser','$tranId20','$ben_name','$ben_acc','$ben_bank','$curr','$amtDeb11','$debit','$tran_status','$rec_acc','$date20'),
            ('$backDateUser','$tranId21','$ben_name','$ben_acc','$ben_bank','$curr','$amtDeb12','$debit','$tran_status','$rec_acc','$date21'),
            
            -- savings added
            ('$backDateUser','$tranId22','$ben_name','$ben_acc','$ben_bank','$curr','$savCred1','$credit','$tran_status','$savings','$date22'),
            ('$backDateUser','$tranId23','$ben_name','$ben_acc','$ben_bank','$curr','$savCred2','$credit','$tran_status','$savings','$date23'),
            ('$backDateUser','$tranId24','$ben_name','$ben_acc','$ben_bank','$curr','$savCred3','$credit','$tran_status','$savings','$date24'),
            ('$backDateUser','$tranId25','$ben_name','$ben_acc','$ben_bank','$curr','$savCred4','$credit','$tran_status','$savings','$date25'),
            ('$backDateUser','$tranId26','$ben_name','$ben_acc','$ben_bank','$curr','$savCred5','$credit','$tran_status','$savings','$date26'),
            -- 2022 debit
            ('$backDateUser','$tranId27','$ben_name','$ben_acc','$ben_bank','$curr','$amtDeb13','$debit','$tran_status','$rec_acc','$date27')
        ");
            // $stmt->bind_param('sssssssssss',$backDateUser,$tranId1,$ben_name,$ben_acc,$ben_bank,$curr,$amt1,$credit,$tran_status,$rec_acc,$date1);
            // $stmt->bind_param('sssssssssss',$backDateUser,$tranId2,$ben_name,$ben_acc,$ben_bank,$curr,$amt2,$debit,$tran_status,$rec_acc,$date2);
            // $stmt->execute();
        if ($sql){
            // current account
            $sqlCred = mysqli_query($conn, "SELECT SUM(amt) AS total FROM acc_history WHERE user_ref='$backDateUser' AND Tran_Typ='Credit' AND Rec_Acc='$rec_acc'");
            $sqlDeb = mysqli_query($conn, "SELECT SUM(amt) AS total FROM acc_history WHERE user_ref='$backDateUser'  AND Tran_Typ='Debit' AND Rec_Acc='$rec_acc'");
            
            $creditfetch = mysqli_fetch_assoc($sqlCred);
            $debitfetch = mysqli_fetch_assoc($sqlDeb);

            $totalCredit = $creditfetch['total'];
            $totalDebit = $debitfetch['total'];

            $sqlAmt = mysqli_query($conn, "UPDATE real_acc SET cBal=cBal+'$totalCredit',cBal=cBal-'$totalDebit' WHERE user_ref='$backDateUser'");

            // savings
            $sqlSavCred = mysqli_query($conn, "SELECT SUM(amt) AS total FROM acc_history WHERE user_ref='$backDateUser' AND Tran_Typ='Credit' AND Rec_Acc='$savings'");
            // $sqlDeb = mysqli_query($conn, "SELECT SUM(amt) AS total FROM acc_history WHERE user_ref='$backDateUser'  AND Tran_Typ='Debit' AND Rec_Acc='$rec_acc'");
            
            $creditSavfetch = mysqli_fetch_assoc($sqlSavCred);
            // $debitfetch = mysqli_fetch_assoc($sqlDeb);

            $totalSavCredit = $creditSavfetch['total'];
            // $totalDebit = $debitfetch['total'];

            $sqlSavAmt = mysqli_query($conn, "UPDATE real_acc SET sBal=sBal+'$totalSavCredit' WHERE user_ref='$backDateUser'");

            if($sqlAmt && $sqlSavAmt){
                echo "<script>alert('Inserted successfully'); window.location.href='./history.php'</script>";
            }else{
                var_dump($conn);
            }
        }else{
            echo "<script>alert('failed to Insert')</script>";
           
        }
    }
}
?>
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
                        <li> <a href="./dashboard">USERS</a></li>
                        <li> <a href="#" class="bg-danger">ACCOUNT HISTORY</a></li>
                        <li> <a href="./codes.php">BILLING CODES</a></li>
                        <li> <a href="./transfer_restrict.php">BLOCK/OPEN TRANSFER</a></li>
                        <li> <a href="./activate.php">ACTIVATE ACC</a></li>
                        <li> <a href="./chats.php" class="chats">CHATS
                                <?php if (mysqli_num_rows($Notificaton) > 0) {
                                    echo  '<div class="notify">' . mysqli_num_rows($Notificaton) . '</div>';
                                } ?>
                            </a></li>
                        <li> <a href="./edit_profile.php">EDIT PROFILE</a></li>
                        <li> <a href="./delete_cust.php">DELETE USER</a></li>
                        <li> <a href="./sign_out.php">SIGNOUT</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="column-large" id="col-large">

            <form action="" method="post">
                <p>Search Result:<?= $search ?> </p>
                <input type="text" name="users" id="user-Search" value="<?= $search ?>" placeholder="Search Users here">
                <button type="submit" name="search">Search</button>
            </form>
            <?php 
                if(isset($_GET['backdatehist'])){
                    $bacdDated = base64_decode($_GET['backdatehist']);
                    ?>
                 
                    <form method="post" class="w-50 mx-auto shadow bg-light p-4 mt-5">
                        <p class="alert alert-danger fs-5 text-center">Are You Sure?</p>
                        <input type="hidden" name="backDate" value="<?=$bacdDated ?>">
                        <div class="buttons text-center">
                            <button type="submit" name="yes" class="btn btn-sm btn-danger">YES</button>
                            <a href="./history.php" class="btn btn-sm btn-primary"">NO</a>
                        </div>
                    </form>
             <?php   }else{?>
                <table class="table table-striped  table-hover" id="searchShow">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>IMAGE</th>
                            <th>USERNAME</th>
                            <th colspan="2">ACTION</th>
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
                                <td><a href="./history_edit.php?edit=<?= base64_encode($row['user_ref']) ?>">View</a></td>
                                <td>
                                    <a href="?backdatehist=<?= base64_encode($row['user_ref']) ?>" class="btn btn-primary">
                                        <?php
                                        $userId = $row['user_ref'];
                                        $sql = mysqli_query($conn, "SELECT * FROM acc_history WHERE user_ref='$userId' AND beneficiary_acc=0000");
                                        if (mysqli_num_rows($sql) > 0) {
                                            echo "<input type='button' value='HIST ADDED' class='fw-bold' style='background: none; border: none' disabled";
                                        } else {
                                            echo "<span>ADD HIST</>";
                                        }
                                        ?>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>;
                        </tbody>
                    </table>
                <?php } ?>
        </div>
    </div>
</div>



<?php require_once './includes/dash_footer.php'; ?>