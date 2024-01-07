<?php
    session_start();
    require './process.php';
   if(!(isset($_SESSION['user']))){
        header("location: ./../login");
    } else {
        $user_Ref = $_SESSION['user']['user_ref'];
        $now = time(); // Checking the time now when home page starts.
        if ($now > $_SESSION['expire']) {
            session_destroy();
            echo "<script>alert('Your session has expired!');window.location.href='./../login'</script>";
       }
      
    } 

    require_once './../includes/email.php'
    
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" /> -->

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.1.1/css/scroller.jqueryui.min.css">
    <link rel="stylesheet" href="./dash.css">
    <title>WELCOME TO STARLING BANK</title>

</head>

<body>
    <div class="dash-container">
        <div class="row">
            <div class="grid-1">
                <div class="bank-logo">
                    <h4>STARLING BANK</h4>
                </div>
                <ul class="agent">
                    <a href="mailto: <?=$email?>" style='font-size: 12px'><?=$email?></a>
                    <p>Customer-support</p>
                </ul>

                <ul class="accounts">
                    <h4>MY ACCOUNT</h4>
                    <li>
                        <a href="dashboard" class="dash-active" id="page1"><span class="material-symbols-outlined">house
                            </span> HOME DASHBOARD</a>
                    </li>
                    <li>
                        <a href="personal_infos"> <span class="material-symbols-outlined"> manage_accounts </span>
                            ACCOUNT DETAILS</a>
                    </li>
                    <li>
                        <a href="acc_history"><span class="material-symbols-outlined">sort </span> ACCOUNT STATEMENT</a>
                    </li>
                </ul>

                <ul class="transfer">
                    <h4>FUND TRANSFER</h4>
                    <li>
                        <a href="transfer"> <span class="material-symbols-outlined">paid</span> BANK TRANSFER</a>
                    </li>
                    <li>
                        <a href="manage-bene"><span class="material-symbols-outlined">history</span> BENEFICIARIES</a>
                    </li>
                </ul>

                <ul class="messages">
                    <h4>MESSAGES</h4>
                    <li>
                        <a href="chat_us"><span class="material-symbols-outlined">mail</span> NEW MESSAGE (<span
                                class="showNotify"></span>) </a>
                    </li>
                    <!-- <li>
                        <a href="#"><span class="material-symbols-outlined">send</span> SENT MESSAGES</a>
                    </li> -->
                </ul>
                <ul class="security">
                    <h4>ACCOUNT SECURITY</h4>
                    <li>
                        <a href="settings"><span class="material-symbols-outlined">lock</span> ACCOUNT PASSWORD</a>
                    </li>
                    <li>
                        <a href="tran_pin"><span class="material-symbols-outlined">pin</span> TRANSACTION PIN</a>
                    </li>
                </ul>
                <ul class="logout">
                    <h4>LOGOUT</h4>
                    <li>
                        <a href="./sign_out.php"><span class="material-symbols-outlined">logout</span> LOGOUT</a>
                    </li>
                </ul>
            </div>
            <div class="grid-2">
                <div class="header-cont">
                    <div class="menu-new">
                        <img src="./dash-img/menu.svg" alt="" class="open">
                    </div>
                    <form action="">
                        <label for="search"><span class="material-symbols-outlined manage">manage_search</span> </label>
                        <input type="text" name="" id="search" placeholder="Type Credit or Debit to Seach">
                        <button class="new-btn">Search <span class="material-symbols-outlined">search</span></button>
                    </form>
                    <div class="users">
                        <div class="notification">
                            <a href="chat.php?notification" style="cursor: pointer">
                                (<span class="showNotify"> </span>) <span
                                    class="material-symbols-outlined">notifications</span>
                            </a>
                        </div>
                        <!-- <div class="profile">
                            <img src="./dash-img/profile.png" alt=""> 
                        </div> -->
                        <div class="profile">
                            <?php
                                //$imageFile = $_SESSION['user']['user_ref'];
                                $imgSql = mysqli_query($conn, "SELECT * FROM OnBanking where user_ref='$user_Ref'");
                                $fetchImage = mysqli_fetch_assoc($imgSql);
                                $imgUploaded = $fetchImage['image'];

                                $reg_info = mysqli_query($conn, "SELECT * FROM users WHERE reg_Ref='$user_Ref'");
                                $fetchReg  = mysqli_fetch_array($reg_info);

                                $last_login = date('l, F d Y');
                                //$last_login = date('l, F d y h:i:s');
                                if($imgUploaded == "NULL"){?>
                            <!-- <i class="fa-solid fa-user" style="width: 70px; height:70px;border-radius: 100%; background-color: #ddd; padding: 10px 15px 0 0;font-size: 40px;margin-right: 5px"></i> -->
                            <span class="material-symbols-outlined"
                                style="width: 70px; height:70px;border-radius: 100%; background-color: #ddd; padding: 10px 15px;font-size: 40px; margin-right: 5px">person</span><span><?=$fetchReg['Names']?></span>
                            <?php }else{?>
                            <img src="./<?=$imgUploaded?>" alt="image"
                                style="width:40px; height:40px;border-radius: 100%; margin-right: 5px">
                            <span><?=$fetchReg['Names']?></span>
                            <?php }
                        ?>
                        </div>
                    </div>
                </div>
                <div class="account-info">
                    <div class="welcome-container">
                        <div class="welcome">
                            <h4 style="color: green">Welcome, <span style="color: #000"><?=$fetchReg['Names']?></span>
                            </h4>
                            <!-- Thursday 2nd of May 2023 -->
                            <p style="color: #"><?=$last_login?></p>
                        </div>

                        <div class="currency">
                            <script src="https://www.macroaxis.com/widgets/url.jsp?t=49"></script>
                            <div class="blank"></div>
                        </div>
                    </div>
                    <div class="image-container">
                        <?php
                            //$imageFile = $_SESSION['user']['user_ref'];
                            $imgSql = mysqli_query($conn, "SELECT * FROM OnBanking where user_ref='$user_Ref '");
                            $fetchImage = mysqli_fetch_assoc($imgSql);
                            $imgUploaded = $fetchImage['image'];
                            if ($imgUploaded == "NULL") { ?>
                        <div class="images" style="margin-right:20px">
                            <!-- <i class="fa-solid fa-user" style="width: 70px; height:70px;border-radius: 100%; background-color: #ddd; padding: 10px 15px 0 0;font-size: 40px; margin-left: 45px"></i> -->
                            <span class="material-symbols-outlined"
                                style="width: 70px; height:70px;border-radius: 100%; background-color: #ddd; padding: 10px 15px;font-size: 40px; margin-left: 45px">person</span>
                            <!-- <i class="fa-solid fa-camera" ></i> -->
                            <span class="material-symbols-outlined" id="upted" onclick="openFile()"
                                style="margin-left: -17px; cursor: pointer;color: red;font-weight: bold ">photo_camera</span>
                            <span class="text-danger text-block"><?= $file_er ?></span>
                        </div>
                        <?php } else { ?>
                        <span class="material-symbols-outlined change" id="upted"
                            onclick="openFile()">photo_camera</span>
                        <!-- <i class="fa-solid fa-camera" onclick="openFile()"></i> -->
                        <img src="./<?= $imgUploaded ?>" alt="image"
                            style="width:90px; height:90px;border-radius: 100%;">
                        <?php } ?>
                        <div class="file" id="uploadForm">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="file" name="fileName" id="dpUploaded" style="display: none;"
                                    onchange="showPhoto(this);">
                                <div class="preview-container">
                                    <img id="preview" src="" alt="photo">
                                    <div class="btn-container d-flex">
                                        <button class="btn btn-primary btn-sm" type="submit"
                                            name="submitFile">Upload</button>
                                        <a href="#" class="btn btn-danger btn-sm"
                                            onclick="location.reload();">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="divider">
                        <div class="indicator"></div>
                    </div>
                </div>