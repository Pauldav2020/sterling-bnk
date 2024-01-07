<?php

    require_once "vendor/autoload.php";
   
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
function registration_confirmation($fName, $email, $company_full_name, $domain_email,$header){
    $mail = new PHPMailer(true);

    $mail->setFrom($domain_email,$header);
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'CUSTOMER\'S REGISTRATION';
    $mail->Body =
    '
    <h3>Dear '.$fName.',</h3>
    <h3>'.$company_full_name.'</h3>
    <h3>ACCOUNT NOTIFICATION</h3>
    <p>Dear '.$fName.', Thank you</p>
    <p>
        For more detailed information about any of our products,
        refer to our website. You many contact us by phone.
    </p>
    <h3 style="background-color: black; color: white;"> INFO</h3>
    <ul>
        <li style="list-style: none; margin: 0;">Rigestration Name: '.$fName.' </li>
    </ul>
    <hr>
    <h5>Regards</h5>
    <h5 style="color: yellow;">'.$company_full_name.'</h5>
    <p>Copyright &copy; 2022 '.$company_full_name.' All rights reserved.</p>
    ';
    try {
    $mail->send();
    // echo "Email has been sent successfully";
    }catch (Exception $e) {
        $mail->ErrorInfo;
    }
}