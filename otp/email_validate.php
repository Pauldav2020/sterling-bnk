<?php
require_once './../config/config.php';

require_once './../process/email.php';

$email = htmlspecialchars($_POST['email']);
$sql = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
if (mysqli_num_rows($sql) > 0) {
    //$result = $conn->query($sql);
    //if (mysqli_num_rows($result) > 0) {
        $result = mysqli_fetch_assoc($sql);
        $fetchEmail = $result['email'];
        $check = mysqli_query($conn, "SELECT * FROM pass_change_otp WHERE email ='$fetchEmail'");
        if (mysqli_num_rows($check) < 1) {
            $otp = rand(000000, 999999);
            $sql = mysqli_query($conn, "INSERT INTO pass_change_otp VALUES(NULL,'$otp','$email')");
            if ($sql) {
                //$sql = mysqli_query($conn, "SELECT * FROM pass_change_otp WHERE email='$email'");
                //$row = mysqli_fetch_array($result);
                //forgetPass($otp, $fetchEmail, $domain_email,$header,$bank_name);
                header('Content-Type: application/json');
                echo  json_encode(['success' => true]);
                //echo json_encode(array('status' => 'inserted', 'data' => $row));
            } else {
                echo json_encode(array('status' => 'failed'));
            }
        } else {
            $otp = rand(000000, 999999);
            $sql = mysqli_query($conn, "UPDATE pass_change_otp SET otp='$otp' WHERE email='$email'");
            if ($sql) {
                //$sql = mysqli_query($conn, "SELECT * FROM pass_change_otp WHERE email='$email'");
                //$row = mysqli_fetch_assoc($result);
                //forgetPass($otp, $fetchEmail, $domain_email,$header,$bank_name);
                header('Content-Type: application/json');
                echo  json_encode(['success' => true]);
                //echo json_encode(array('status' => 'updated', 'data' => $row));
            } else {
                echo json_encode(array('status' => 'error'));
            }
        }
    //} else {
        //echo json_encode(array('status' => 'invalid'));
    //}
} else {
    echo json_encode(['success' => false]);
}