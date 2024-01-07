<?php 

    $selectCard = $amt = '';


    if(isset($_POST['credit_cards'])){
        $user_id = $_POST['userId'];
        if(!empty($_POST['cards'])){
            $selectCard = htmlspecialchars($_POST['cards']);
            echo $selectCard ;
        }else{
            $selectCard = '';
        }
        if(!empty($_POST['amount'])){
            $amount = htmlspecialchars($_POST['amount']);
            $amt = preg_replace("/,/", "",$amount);
        }else{
            $amt = '';
        }
        if($amt !== "" && $selectCard !== "")
            if($selectCard == 'visa'){
                $credit = mysqli_query($conn, "UPDATE real_acc SET visaBal=visaBal+'$amt' WHERE user_ref='$user_id'");
                if($credit){
                    echo '<script>alert("Visa card has been funded")</script>';
                }
            }else{
                $credit = mysqli_query($conn, "UPDATE real_acc SET creditBal=creditBal+'$amt' WHERE user_ref='$user_id'");
                if($credit){
                    echo '<script>alert("Master card has been funded")</script>';
                }
            }
        else echo '<script>alert("All fields are required")</script>';;
            
        
    }

    if(isset($_POST['update_cards'])){
        $user_id = $_POST['userId'];
        if(!empty($_POST['cards'])){
            $selectCard = htmlspecialchars($_POST['cards']);
            echo $selectCard ;
        }else{
            $selectCard = '';
        }
        if(!empty($_POST['amount'])){
            $amount = htmlspecialchars($_POST['amount']);
            $amt = preg_replace("/,/", "",$amount);
        }else{
            $amt = '';
        }
        if($amt !== "" && $selectCard !== "")
            if($selectCard == 'visa'){
                $credit = mysqli_query($conn, "UPDATE real_acc SET visaBal=visaBal-'$amt' WHERE user_ref='$user_id'");
                if($credit){
                    echo '<script>alert("Visa card has been updated")</script>';
                }
            }else{
                $credit = mysqli_query($conn, "UPDATE real_acc SET creditBal=creditBal-'$amt' WHERE user_ref='$user_id'");
                if($credit){
                    echo '<script>alert("Master card has been updated")</script>';
                }
            }
        else echo '<script>alert("All fields are required")</script>';;
            
        
    }


?>