<?php

require_once './config/config.php';
$user_Ref = $_SESSION['user']['user_ref'];

$brokSql = mysqli_query($conn, "SELECT * FROM brook_beneficiary WHERE cust_Ref='$user_Ref'");
$otherSql = mysqli_query($conn, "SELECT * FROM other_beneficiary WHERE cust_Ref='$user_Ref'");



?>


    <div class="bank-back-container" id="bank-back">
        <div class="bank-container" id="bankCon" style="display:block!important" >
            <!-- <span class="close-ben-btn" onclick="window.location.reload();">&times</span> -->
            <div class="buttons-show mt-3">
                <button class="same-ben active" data-list=".brook" id="brok-Btn" >STARLING</button>
                <button class="same-ben second-Btn" data-list=".other-acc" id="other-Btn">OTHER BANK</button>
            </div>
            <div class="beneficiareis">
                <div class="brookline" >
                    <select name="brook" id="showBrook" class="select-ben brook active"  onchange="showUsers()" >
                        <option value="" >Select Beneficiary</option>
                        <?php while ($row1 = mysqli_fetch_assoc($brokSql)){?>
                            <option value="<?=$row1['beneficiary_Ref']?>"><?=$row1['name']."-".$row1['acc_Num']?> </option>
                        <?php }?>
                    </select>
                    <div id="showTxt"></div>
                </div>
                <div class="others" id="">
                    <select name="other" id="showOther"  onchange="showOtherUsers()" class="select-ben other-acc ">
                        <option value="">Select Beneficiary</option>
                        <?php while($row = mysqli_fetch_assoc($otherSql)){?>
                            <option  value="<?=$row['id']?>"><?=$row['name']."-".$row['acc_Num']?></option>
                        <?php   }?>
                    </select>
                    <div id="showOtherTxt"></div>
                </div>
            </div>
        </div>
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="./js/transfer.js"></script> -->
