<?php 
    error_reporting(0);
    require_once 'email.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.1.1/cerulean/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="icon" type="image/png" href="../assets/images/fave.png">
    <link rel="stylesheet" href="./assets/pages-css/style.css">
    <title>WELCOME TO STARLING COMMUNITY BANK</title>
</head>
<body id="body1">
    <header>
        <nav>
            <div class="navigation-bar">
                <div class="bank-info">
                    <ul class="phone">
                        <li class="phone"><a href="tel:+(+1)440">(+44) 440-721</a></li>
                        <li class="email"><a href="mailto:<?=$email?>"><?=$email?></a></li>
                    </ul>
                </div>
            </div>
            <div class="navigation-list">
                <div class="list-container">
                    <div class="brand-logo" style="cursor: pointer!important;">
                        <a href="index"  ><img src="./../assets/images/starling-logo.png" alt="Logo" style="margin: 10px"></a>
                        <span id="open-nav-btn" onclick="showNav()"><i class="fa-solid fa-bars"></i></span>
                    </div>
                    <ul class="list" id="nav-content" onclick="closed(event)">
                    <li></li>
                        <!-- <span class="nav-close" id="close-nav-btn">&times</span> -->
                        <li><a href="personal-banking">Personal Banking</a></li>
                        <li><a href="business-banking">Small Business</a></li>
                        <li><a href="loans">Loans</a></li>
                        <li><a href="commercial-banking">Commercial Banking</a></li>
                        <li><a href="invest-rt">Investment Banking</a></li>
                        <li class="online"><a href="login"><i class="fa fa-lock rt-mega-menu-icon"></i>Online Banking</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div id="works">