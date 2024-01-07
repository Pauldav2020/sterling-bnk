<?php
   session_start();
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
    <link rel="stylesheet" href="./assets/scss/style.css">
    <title>STARLING</title>
</head>
<body>
    <header>
        <nav>
            <div class="navigations">
                <ul class="secondary">
                    <li><a href="contact-us">Locate<i class="fa-solid fa-angle-down"></i></a></li>
                    <li><a href="">Media</a></li>
                    <li><a href="mailto:<?=$email?>">Help Centre<i class="fa-solid fa-angle-down"></i></a></li>
                    <li><a href="">Security</a></li>
                    <li><a href=""><i class="fa-solid fa-magnifying-glass"></i></a></li>
                </ul>
                <ul class="primary">
                    <li><a href="../login"><i class="fa-solid fa-lock"></i>Login<i class="fa-solid fa-angle-right"></i></a></li>
                </ul>
            </div>
        </nav>
    </header>