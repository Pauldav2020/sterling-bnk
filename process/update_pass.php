<?php
    require_once './configs/config.php';

    require_once "vendor/autoload.php";

    // email function
    require_once './email.php';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    if(mysqli_num_rows($result) > 0){
        $check = mysqli_query($conn, "SELECT * FROM pass_change_otp WHERE email ='$email'");
        if(mysqli_num_rows($check) < 1){
            $otp = rand(000000,999999);
            $sql = mysqli_query($conn, "INSERT INTO pass_change_otp VALUES(NULL,'$otp','$email')");
            if($sql){
                $sql = mysqli_query($conn, "SELECT * FROM pass_change_otp WHERE email='$email'");
                $row = mysqli_fetch_array($result);
                forgetPass($otp,$email,$domain_email,$header,$bank_name);
                echo json_encode(array('status' => 'inserted','data' => $row)); 
            }else{
                echo json_encode(array('status' => 'failed'));
            }
        }else{
            $otp = rand(000000,999999);
            $sql = mysqli_query($conn, "UPDATE pass_change_otp SET otp='$otp'");
            if($sql){
                $sql = mysqli_query($conn, "SELECT * FROM pass_change_otp WHERE email='$email'");
                $row = mysqli_fetch_assoc($result);
                forgetPass($otp,$email,$domain_email,$header,$bank_name);
                echo json_encode(array('status' => 'updated','data' => $row));
            }else{
                echo json_encode(array('status' => 'error'));
            }
        }
    }else{
        echo json_encode(array('status' => 'invalid'));
    }
?>