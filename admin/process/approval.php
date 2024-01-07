<?php
    session_start();
    $now = time();
    require_once './../../config/config.php';

    // email service: credit/debit alert 
    require_once './../../process/email.php';

    $approved = $_POST['approval'];

    $sqlFetch = mysqli_query($conn, "SELECT * FROM acc_history WHERE tran_status='PENDING' AND tran_Ref='$approved'");

    // credit approval request
    if (mysqli_num_rows($sqlFetch) > 0) {
        $sql = mysqli_query($conn, "UPDATE acc_history SET tran_status='APPROVED' WHERE tran_Ref='$approved'");
        if ($sql) {
            $sqlSerch = mysqli_query($conn, "SELECT * FROM acc_history WHERE Tran_Typ='Credit' AND tran_Ref='$approved'");
            if (mysqli_num_rows($sqlSerch) > 0) {
                $rowCredit = mysqli_fetch_assoc($sqlSerch);
                $creditAmt = $rowCredit['amt'];
                $credit = number_format($creditAmt, 2);
                $userRef = $rowCredit['user_ref'];
                $creditCur = $rowCredit['currency'];
                $senderName = $rowCredit['beneficiary_name'];
                $senderAcc = $rowCredit['beneficiary_acc'];
                $senderBank = $rowCredit['beneficiary_bank'];
                $rec_Acc = $rowCredit['Rec_Acc'];
                if ($rowCredit['Tran_Typ'] == 'Credit') {
                    // fetch account to credit
                    $checkAcc = mysqli_query($conn, "SELECT * FROM users WHERE reg_Ref='$userRef'");
                    $fetchAcc = mysqli_fetch_assoc($checkAcc);
                    $rec_Name = $fetchAcc['Names'];
                    $email  = $fetchAcc['email'];
                    $savings = $fetchAcc['Sav_Acc_No'];
                    $checking = $fetchAcc['Check_Acc_No'];
                    if ($rec_Acc  == $savings) {
                        $savUpdate = mysqli_query($conn, "UPDATE real_acc SET sBal=sBal+'$creditAmt' WHERE user_ref='$userRef'");
                        if ($savUpdate) {
                            $realDate = "02-Jul-2022";
                            $date = date('d-m-Y', strtotime($realDate));
                            $time = date('H:i');
                            $credRef = rand(000000000000, 999999999999);
                            $sqlBal = mysqli_query($conn, "SELECT * FROM real_acc WHERE user_ref='$userRef'");
                            if ($sqlBal) {
                                $rowBal = mysqli_fetch_assoc($sqlBal);
                                $Avail_Bal = number_format($rowBal['sBal'], 2);
                                sendCredit($creditCur, $email, $credit, $Avail_Bal, $rec_Name, $rec_Acc, $credRef, $senderBank, $senderAcc, $senderName, $date, $time, $domain_email, $header, $bank_name);
                                echo json_encode(array('status' => 'credit200'));
                            }
                        }
                    } else {
                        if ($rec_Acc  == $checking) {
                            $checkUpdate = mysqli_query($conn, "UPDATE real_acc SET cBal=cBal+'$creditAmt' WHERE user_ref='$userRef'");
                            if ($checkUpdate) {
                                $realDate = "02-Jul-2022";
                                $date = date('d-m-Y', strtotime($realDate));
                                $time = date('H:i');
                                $credRef = rand(000000000000, 999999999999);
                                $sqlBal = mysqli_query($conn, "SELECT * FROM real_acc WHERE user_ref='$userRef'");
                                if ($sqlBal) {
                                    $rowBal = mysqli_fetch_assoc($sqlBal);
                                    $Avail_Bal = number_format($rowBal['cBal'], 2);
                                    sendCredit($creditCur, $email, $credit, $Avail_Bal, $rec_Name, $rec_Acc, $credRef, $senderBank, $senderAcc, $senderName, $date, $time, $domain_email, $header, $bank_name);

                                    echo json_encode(array('status' => 'credit200'));
                                }
                            }
                        } else {
                            $sqled = mysqli_query($conn, "UPDATE real_acc SET loanBal=loanBal+'$creditAmt' WHERE user_ref='$userRef'");
                            if ($sqled) {
                                $realDate = "02-Jul-2022";
                                $date = date('d-m-Y', strtotime($realDate));
                                $time = date('H:i');
                                $credRef = rand(000000000000, 999999999999);
                                $sqlBal = mysqli_query($conn, "SELECT * FROM real_acc WHERE user_ref='$userRef'");
                                if ($sqlBal) {
                                    $rowBal = mysqli_fetch_assoc($sqlBal);
                                    $Avail_Bal = number_format($rowBal['loanBal'], 2);

                                    sendCredit($creditCur, $email, $credit, $Avail_Bal, $rec_Name, $rec_Acc, $credRef, $senderBank, $senderAcc, $senderName, $date, $time, $domain_email, $header, $bank_name);

                                    echo json_encode(array('status' => 'credit200'));
                                }
                            }
                        }
                    }
                    // else{
                    //     header("content-type: application/text");
                    //     echo json_encode(array('status' => 'error_credit'));     
                    // }
                }
            } else {
                // debit approval request
                $sqlDebit = mysqli_query($conn, "SELECT * FROM acc_history WHERE Tran_Typ='Debit' AND tran_Ref='$approved'");
                if (mysqli_num_rows($sqlDebit) > 0) {
                    $rowDebit = mysqli_fetch_assoc($sqlDebit);
                    $debitAmt = $rowDebit['amt'];
                    $userDebit = $rowDebit['user_ref'];
                    $debitCur = $rowDebit['currency'];
                    $receiver = $rowDebit['beneficiary_name'];
                    $receiverAcc = $rowDebit['beneficiary_acc'];
                    $receiverBank = $rowDebit['beneficiary_bank'];
                    $rec_Acc = $rowDebit['Rec_Acc'];
                    $sqlName = mysqli_query($conn, "SELECT * FROM users WHERE reg_Ref='$userDebit'");
                    $rowName = mysqli_fetch_assoc($sqlName);
                    $custName = $rowName['Names'];
                    $email = $rowName['email'];
                    $savings = $rowName['Sav_Acc_No'];
                    $checking = $rowName['Check_Acc_No'];
                    if ($receiver != $custName) {
                        $beneficiary = $receiver;
                    } else {
                        $beneficiary = "";
                    }
                    if ($receiverAcc != $rec_Acc) {
                        $beneficiaryAcc = $receiverAcc;
                    } else {
                        $beneficiaryAcc = "";
                    }
                    if ($receiverBank != "PCB") {
                        $bank = $receiverBank;
                    } else {
                        $bank = "";
                    }
                    if ($rec_Acc == $savings) {
                        $sql = mysqli_query($conn, "UPDATE real_acc SET sBal=sBal-'$debitAmt' WHERE user_ref='$userDebit'");
                        if ($sql) {
                            $debit = number_format($debitAmt, 2);
                            $realDate = "02-Jul-2022";
                            $date = date('d-m-Y', strtotime($realDate));
                            $time = date('H:i');
                            $ref = rand(000000000000, 999999999999);
                            $sqlBal = mysqli_query($conn, "SELECT * FROM real_acc WHERE user_ref='$userDebit'");
                            if ($sqlBal) {
                                $rowBal = mysqli_fetch_assoc($sqlBal);
                                $aBal = number_format($rowBal['sBal'], 2);
                                sendDebit($debitCur, $email, $debit, $aBal, $custName, $rec_Acc, $ref, $bank, $beneficiaryAcc, $beneficiary, $date, $time, $domain_email, $header, $bank_name);
                                // header("content-type: application/text");
                                echo json_encode(array('status' => 200));
                            }
                        }
                    } else {
                        $sql = mysqli_query($conn, "UPDATE real_acc SET cBal=cBal-'$debitAmt' WHERE user_ref='$userDebit'");
                        if ($sql) {
                            $debit = number_format($debitAmt, 2);
                            $realDate = "02-Jul-2022";
                            $date = date('d-m-Y', strtotime($realDate));
                            $time = date('H:i');
                            $ref = rand(000000000000, 999999999999);
                            $sqlBal = mysqli_query($conn, "SELECT * FROM real_acc WHERE user_ref='$userDebit'");
                            if ($sqlBal) {
                                $rowBal = mysqli_fetch_assoc($sqlBal);
                                $aBal = number_format($rowBal['cBal'], 2);
                                sendDebit($debitCur, $email, $debit, $aBal, $custName, $rec_Acc, $ref, $bank, $beneficiaryAcc, $beneficiary, $date, $time, $domain_email, $header, $bank_name);
                                // header("content-type: application/text");
                                echo json_encode(array('status' => 200));
                            }
                        }
                    }
                }
            }
        }
    } else {
        // header("content-type: application/text");
        echo json_encode(array('status' => 'error500'));
    }

