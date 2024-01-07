<?php
    // AUTO_LOAD
    require_once "vendor/autoload.php";
   
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    $domain_email = "mailserv@stallingroup.com";

    $header = "STARLING";
    // SAMPLE BELOW OF EMAIL AND HEADER
    // $mail->setFrom('plaininfopcb@plaincapfnc.com','PCB');

    // BANK NAME/FULL NAME
    $bank_name = "SB_INC";
    $bank_full_name = "STARLING BANK";

    // ACCOUNT REGISTRATION COMFIRM EMAIL FUNCTION
    function registration_confirmation($fName, $email, $sav_Acc,$check_Acc,$user,$domain_email,$header,$bank_name,$bank_full_name){
        $mail = new PHPMailer(true);
         
        
        $mail->setFrom($domain_email,$header);
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'CUSTOMER\'S ACCOUNT REGISTRATION';
        $mail->Body = 
         '
          <h3>Dear '.$fName.',</h3>
          <h3>'.$bank_full_name.'</h3>
          <h3>ACCOUNT NOTIFICATION</h3>
          <p>Dear '.$fName.', Thank you for allowing us to help you with your recent account opening. We are committed to
            providing our customers with the highest level of service and the most innovative banking products possible. We are
            glad you chose us a s your financial institution and hope you will take advantage of our wide variety of savings,
            investment and loan products, all designed to meet your specific needs.
          </p>
          <p>
            For more detailed i nformation about any of our products, loans, credit cards or other financial services, please refer to
            our website. You many contact us by phone.
          </p>
          <p>Your '.$bank_name.' account numbers Are:
                <ul>
                  <li>Checking Account Number: '.$check_Acc.'</li>
                  <li>Savings Account Number: '.$sav_Acc.'</li>
              </ul>
          
          </p>
          <h3 style="background-color: black; color: white;"> ONLINE BANKING DETAILS:</h3>
          <ul>
            <li style="list-style: none; margin: 0;">Username : '.$user.'</li>
            <li style="list-style: none; margin: 0;">Account name : '.$fName.' </li>
          </ul>
          <hr>
          <h5>Regards</h5>
          <h5 style="color: yellow;">'.$bank_full_name.'</h5>
          <p> 
            Please do not hesitate to contact us should you have any question.
            We will contact you in the near future to ensure you are completely satisfied with our services.
          </p>
          <p>Copyright &copy; 2022 '.$bank_name.' All rights reserved.</p>
        ';
        try {
          $mail->send();
            // echo "Email has been sent successfully";
        }catch (Exception $e) {
          $mail->ErrorInfo;
        }   
      }
     // ACCOUNT REGISTRATION CONFIRMATION ENDS   


    // OTP GENERATOR CODE
    function sendotp($otp, $email,$domain_email,$header,$bank_name){
        $mail = new PHPMailer(true);


        $mail->setFrom($domain_email,$header);
        $mail->addAddress($email);
        $mail->isHTML(true);
            
        $mail->Subject = "OTP VERIFICATION CODE";
        $mail->Body = "
            <h5> <strong>Dear Valued Customer,</strong></h5>
            <p>Your Login Verification Code is: $otp</p>
            <p> Please do not share this code with others.</p>
            <p>If you did not initiate this request, Kindly contact support immediately.</p>
            <h6> <strong>$bank_name Team</strong></h6>
            <p>If you have any questions, please feel free to contact us</p>
        ";
        $mail->AltBody = "This is the plain text version of the email content";
        try {
            $mail->send();
            //echo "Email sent successfully";
        } catch (Exception $e) {
            echo $mail->ErrorInfo;
        }
    }
    // OTP GENERATOR ENDS HERE


    
    // LOGIN NOTIFICATION STARTS HERE 
    function sendNotification($names, $email,$date,$domain_email,$header){
        $mail = new PHPMailer(true);
        
        $mail->setFrom($domain_email,$header);
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'SPRING-ONLINE LOG IN CONFIRMATION';
        $mail->Body = 
        '
          <html lang="en">
            <body">
              <h3>Dear '.$names.'</h3>
              <p>Please be informed that your SPRING-ONLINE profile was
              accessed at '.$date.' - IP Address:  </p>
              <p> If you did not log on to your SPRING-ONLINE profile at the time detailed above, Please send an Email</p>
              <p>Thank you for banking with us.</p>
            </body>
          </html>
        ';
        try {
            $mail->send();
            // echo "Email has been sent successfully";
        }catch (Exception $e) {
          $mail->ErrorInfo;
        }   
      }
    // LOGIN NOTIFICTION ENDS HERE 



    // CHANGE PASSWORD VERIFICATION
    function forgetPass($otp,$email,$domain_email,$header,$bank_name){
        $mail = new PHPMailer(true);
        $mail->setFrom($domain_email,$header);
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "OTP VERIFICATION CODE";
        $mail->Body = "
            <h5> <strong>Dear Valued Customer,</strong></h5>
            <p>Your Password Verification Code is: $otp</p>
            <p> Please do not share this code with others.</p>
            <p>If you did not initiate this request, Kindly contact support immediately.</p>
            <h6> <strong>'.$bank_name.' Team</strong></h6>
            <p>If you have any questions, pleae feel free to contact us at <a href='#'>Email</a></p>
        ";
        $mail->AltBody = "This is the plain text version of the email content";
        try {
            $mail->send();
        } catch (Exception $e) {
            $mail->ErrorInfo;
        }
    }
    // CHANGE PASSWORD ENDS HERE



    // CREDIT ALERT FUNCTION STARTS HERE
    function sendCredit($creditCur,$email,$credit,$Avail_Bal,$rec_Name,$rec_Acc,$credRef,$senderBank,$senderAcc,$senderName,$date,$time,$domain_email,$header,$bank_name){
        $mail = new PHPMailer(true);
        
        $mail->setFrom($domain_email,$header);
        $mail->addAddress($email);
        $mail->isHTML(true);
        
        $mail->Subject = "Transaction Alert[Credit: $creditCur$credit]";
        $mail->Body = "
            <h4>Dear <strong>$rec_Name</strong></h>
            <p>We wish to inform you that a Credit transaction occured on your account with us.
            <br> The details of this transaction are shown below:</p>
            <h5 style='text-decoration: underline;'> Transaction Notification</h5>
            <ul style='margin:0;padding: 0;font-size: 10px;'>
                <li  style='list-style: none; margin-top: 5px;margin-left: 0;'>Account Number: <span style='margin-left: 10px;'>$rec_Acc</span></li>
                <li style='list-style: none;margin-top: 5px;margin-left : 0;'>Transaction Location: <span style='margin-left: 10px;'>E-CHANNELS</span></li>
                <li style='list-style: none;margin-top: 5px;margin-left : 0;'>Description: <span style='margin-left: 10px;'>TRANSFER BETWEEN CUSTOMERS</span></li>
                <li style='list-style: none;margin-top: 5px;margin-left : 0;'>Amount: <span style='margin-left: 10px;' >$credit</span></li>
                <li style='list-style: none;margin-top: 5px;margin-left : 0;'>Value Date: <span style='margin-left: 10px;'>$date</span></li>
                <li style='list-style: none;margin-top: 5px;margin-left : 0;'>Remarks: <span style='margin-left: 10px;'>$bank_name- from $senderAcc-$senderName-$senderBank to $rec_Acc PMF REF:
                $credRef</span></li>
                <li style='list-style: none;margin-top: 5px;margin-left : 0;'>Time of Transaction: <span style='margin-left: 10px;font-size: 11px'>$time</span></li>
                <li style='list-style: none;margin-top: 5px;margin-left : 0;'>Document Number: <span style='margin-left: 10px;font-size: 11px'>0</span></li>
            </ul>
            <h5> <strong>The balances on this account as at $time are as follows:</strong></h5>
            <ul style='margin:0;padding: 0;'>
                <li  style='list-style: none;margin-top: 5px;'>Available Balance : <span>$Avail_Bal</span></li>
            </ul>
            <p>The privacy and Security of your Bank Account details is IMPORTANT to us. if you would prefere that we
            do not display your account balance in every transaction alert sent to you via email please Contact us</p>
            <p>Thank you for choosing <b>$bank_name</b>
        ";
        $mail->AltBody = "This is the plain text version of the email content";
        
        try {
            $mail->send();
            // echo "Message has been sent successfully";
            
        } catch (Exception $e) {
            //  $mail->ErrorInfo;
             $mail->ErrorInfo;
        }
    }
    // CREDIT ALERT FUNCTION ENDS HERE


    // DEBIT ALERT FUNCTION STARTS HERE
    function sendDebit($debitCur,$email,$debit,$aBal,$custName,$rec_Acc,$ref,$bank,$beneficiaryAcc,$beneficiary,$date,$time,$domain_email,$header,$bank_name){
        $mail = new PHPMailer(true);

        $mail->setFrom($domain_email,$header);
        $mail->addAddress($email);
        $mail->isHTML(true);
        
        $mail->Subject = "Transaction Alert[Debit: $debitCur $debit]";
        $mail->Body = "
            <h4>Dear <strong>$custName</strong></h>
            <p>We wish to inform you that a Debit transaction occured on your account with us.
            <br> The details of this transaction are shown below:</p>
            <h5 style='text-decoration: underline;'> Transaction Notification</h5>
            <ul style='margin:0;padding: 0;font-size: 10px;'>
                <li  style='list-style: none; margin-top: 5px;margin-left: 0;'>Account Number: <span style='margin-left: 10px;'>$rec_Acc</span></li>
                <li style='list-style: none;margin-top: 5px;margin-left : 0;'>Transaction Location: <span style='margin-left: 10px;'>E-CHANNELS</span></li>
                <li style='list-style: none;margin-top: 5px;margin-left : 0;'>Description: <span style='margin-left: 10px;'>TRANSFER BETWEEN CUSTOMERS</span></li>
                <li style='list-style: none;margin-top: 5px;margin-left : 0;'>Amount: <span style='margin-left: 10px;' >$debit</span></li>
                <li style='list-style: none;margin-top: 5px;margin-left : 0;'>Value Date: <span style='margin-left: 10px;'>$date</span></li>
                <li style='list-style: none;margin-top: 5px;margin-left : 0;'>Remarks: <span style='margin-left: 10px;'>$bank_name - from  $custName to  $beneficiary - $beneficiaryAcc-$bank PMF REF:
                $ref</span></li>
                <li style='list-style: none;margin-top: 5px;margin-left : 0;'>Time of Transaction: <span style='margin-left: 10px;font-size: 11px'>$time</span></li>
                <li style='list-style: none;margin-top: 5px;margin-left : 0;'>Document Number: <span style='margin-left: 10px;font-size: 11px'>0</span></li>
            </ul>
            <h5> <strong>The balances on this account as at $time are as follows:</strong></h5>
            <ul style='margin:0;padding: 0;'>
                <li  style='list-style: none;margin-top: 5px;'>Available Balance : <span>$aBal</span></li>
            </ul>
            <p>The privacy and Security of your Bank Account details is IMPORTANT to us. if you would prefere that we
            do not display your account balance in every transaction alert sent to you via email please Contact us</p>
            <p>Thank you for choosing <b>$bank_name</b>
        ";
        $mail->AltBody = "This is the plain text version of the email content";
        try {
            $mail->send();
            // echo "Message has been sent successfully";  
        } catch (Exception $e) {
        //    echo "Mail ErrorInfo".
             $mail->ErrorInfo;
        }
    }
    // DEBIT ALERT FUNCTION ENDS HERE
?>