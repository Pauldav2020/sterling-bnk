<?php 
    require './includes/new_header.php';
    include './sideHeight.php';
 
    $sql = mysqli_query($conn, "SELECT * FROM users LEFT JOIN OnBanking ON users.reg_Ref = OnBanking.user_ref WHERE reg_ref='$user_Ref' AND user_ref='$user_Ref'");
    $fetchNames = mysqli_fetch_assoc($sql);
?>

<div class="personal_details">
    <div class="container">
        <div class="overview">
            <h3>account holder's overview</h3>
            <div class="divider"></div>
        </div>
        <ul class="grid-container">
           <li>
                <span class="material-symbols-rounded">
                    person
                </span>
                <div class="content">
                    <h4>Account Holder</h4>
                    <p><?=$fetchNames['Names']?></p>
                </div>
           </li>
           <li>
                <span class="material-symbols-rounded">home_pin</span>
                <div class="content">
                    <h4>Account Holder's Country</h4>
                    <p><?=$fetchNames['country']?></p>
                </div>
           </li>
           <li>
                <span class="material-symbols-rounded">person_book</span>
                <div class="content">
                    <h4>Account Number</h4>
                    <p><?='*****'.substr($fetchNames['Check_Acc_No'],5,11)?></p>
                </div>
           </li>
           <li>
                <span class="material-symbols-rounded">person</span>
                <div class="content">
                    <h4>gender</h4>
                    <p><?=strtoupper($fetchNames['gender'])?></p>
                </div>
           </li>
           <li>
                <span class="material-symbols-rounded">mail</span>
                <div class="content">
                    <h4>Account holder's Email</h4>
                    <p><?=$fetchNames['email']?></p>
                </div>
           </li>
           <li>
                <span class="material-symbols-rounded">calendar_month</span>
                <div class="content">
                    <h4>Account Opening Date</h4>
                    <p>---</p>
                </div>
           </li>
           <li>
                <span class="material-symbols-rounded">domain</span>
                <div class="content">
                    <h4>bank branch code</h4>
                    <p>6j0bprm1510qb</p>
                </div>
           </li>
           <li>
                <span class="material-symbols-rounded">call</span>
                <div class="content">
                    <h4>Account holder's phone</h4>
                    <p><?=$fetchNames['phone']?></p>
                </div>
           </li>
           <li>
                <span class="material-symbols-rounded">thumb_up</span>
                <div class="content">
                    <h4>Account status</h4>
                  
                        <?php
                           echo ($fetchNames['status'] === 'ACTIVE') ? '<p style="color: green; font-weight: bold">'.$fetchNames['status']. '</p>' : '<p style="color: red; font-weight: bold">'.$fetchNames['status']. '</p>';
                        ?>
                   
                </div>
           </li>
           <li>
                <span class="material-symbols-rounded">login</span>
                <div class="content">
                    <h4>last login</h4>
                    <p><?=date('y-m-d H:s:i')?></p>
                </div>
           </li>
        </ul>
    </div>
</div>

<?php require './includes/new_footer.php' ?>