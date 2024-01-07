<?php
//  require_once './header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.1.1/cerulean/bootstrap.min.css">

    <title>Document</title>
    <style>
    .scrollstop {
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .container {
        width: 500px;
        margin: 200px auto;
        /* height: 100vh;
        margin: 200px auto;
        background-color: #ccc; */

    }

    .row {
        position: relative;
    }

    ::placeholder {
        font-weight: bold;
    }

    /* input{
       width: 50%; 
       margin: 20px 0 0 100px;
       padding: 10px;
       border: 2px solid blue;
    } */
    p.verify-text {
        width: 70%;
        margin: 10px auto;
        color: #f00;
        font-weight: bold;
    }

    @media only screen and (min-width: 768px) {
        .container {
            width: 700px;
        }
    }

    @media only screen and (min-width: 1200px) {
        .container {
            width: 500px;
            box-sizing: border-box;
        }

        p.verify-text {
            width: 80%;
            font-size: 16px;
            margin: 10px auto;
            color: #f00;
            font-weight: bold;
        }

    }

    .spinner-background {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgb(0, 0, 0, 0);
        background-color: rgba(0, 0, 0, 0.5);
    }

    .text-center {
        margin-top: 200px;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row text-center mx-auto w-100 my-5 shadow-lg bg-light">
            <p class="verify-text">OTP code has been sent to your email for login verification(code last for 10min)</p>
            <form action="" method="post" autocomplete="off" id="submit-otp">
                <!-- <input type="hidden" id="userInput"> -->
                <input type="password" name="otp" placeholder="Enter 6 digits OTP code" id="otp"
                    class="form-control form-control-sm w-50 mx-auto" onkeydown="limit(this)" onkeyup="limit(this)"
                    onkeypress="return (event.charCode !=8 && event.charCode ==0 ||(event.charCode == 46 ||(event.charCode >=48 && event.charCode <=57)))"
                    required=true>
                <span id="otp_er" class="text-danger d-block"></span>
                <button type="submit" class="btn btn btn-primary w-50 my-3 mx-auto " onclick="">Login</button>
            </form>
            <div class="spinner-background">
                <div class="text-center" id="spiner" style="color:red;">
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
function limit(element) {
    var num_limit = 6;
    if (element.value.length > num_limit) {
        element.value = element.value.substr(0, num_limit);
    }
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="./js//ajax.js"></script> -->

</html>
<script src="../js/login.js"></script>