<?php
require_once '../config/config.php';
require_once './includes/reg-header.php';
require_once './process.php';



$admin_Ref = 'REG-1027021';

//$msg_sql = mysqli_query($conn, "SELECT * FROM chats WHERE user_id='$user_Ref' ORDER BY id ASC");

$sn = 1;

//search query
if (isset($_POST["search"])) {
    $search = $_POST["users"];
} else {
    $search = "";
}
if (isset($_POST["yes"])) {
    $loginActive = $_POST["activate"];
    $sql  = mysqli_query($conn, "SELECT * FROM OnBanking WHERE user_ref = '$loginActive'");
    if (mysqli_num_rows($sql) > 0) {
        $fetchUsers = mysqli_fetch_array($sql);
        if ($fetchUsers['valid_user'] == "Pending") {
            $sql  = mysqli_query($conn, "UPDATE OnBanking SET valid_user='Approved' WHERE user_ref = '$loginActive'");
            if ($sql == true) {
                echo "<script>alert('Login has been approved');window.location.href='dashboard'</script>";
            } else {
                echo "<script>alert('Login failed');window.location.href='dashboard'</script>";
            }
        } else {
            $sql  = mysqli_query($conn, "UPDATE OnBanking SET valid_user='Pending' WHERE user_ref = '$loginActive'");
            if ($sql == true) {
                echo "<script>alert('Login has been suspended');window.location.href='dashboard'</script>";
            } else {
                echo "<script>alert('Login failed');window.location.href='dashboard'</script>";
            }
        }
    }
}


?>
<style>
    /* Button used to open the chat form - fixed at the bottom of the page */
    .open-button {
        background-color: #555;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        opacity: 0.8;
        position: fixed;
        bottom: 23px;
        right: 28px;
        width: 280px;
    }

    /* The popup chat - hidden by default */
    .chat-popup {
        display: none;
        position: fixed;
        bottom: 0;
        right: 15px;
        /* border: 3px solid #f1f1f1; */
        z-index: 9;
    }

    #myFormheader{
        position: relative;
        max-width: 300px;
        padding: 10px;
        cursor: move;
        z-index: 10;
        background-color: #2196F3;
        color: #fff;
        cursor: move;
    }


    /* Add styles to the form containered */
    .form-containered {
        max-width: 300px;
        padding: 10px;
        background-color: white;
    }

    /* Full-width textarea */
    .form-containered textarea {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        border: none;
        background: #f1f1f1;
        resize: none;
        min-height: 200px;
    }

    /* When the textarea gets focus, do something */
    .form-containered textarea:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Set a style for the submit/send button */
    .form-containered .btn {
        background-color: #04AA6D;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        margin-bottom: 10px;
        opacity: 0.8;
    }

    /* Add a red background color to the cancel button */
    .form-containered .cancel {
        background-color: red;
    }

    /* Add some hover effects to buttons */
    .form-containered .btn:hover,
    .open-button:hover {
        opacity: 1;
    }

    .containered {
        border: 2px solid #dedede;
        background-color: #f1f1f1;
        border-radius: 5px;
        padding: 10px;
        margin: 10px 0;
    }

    .darker {
        border-color: #ccc;
        background-color: #ddd;
    }

    .containered::after {
        content: "";
        clear: both;
        display: table;
    }

    .containered img {
        float: left;
        max-width: 60px;
        width: 100%;
        margin-right: 20px;
        border-radius: 50%;
    }

    .containered img.right {
        float: right;
        margin-left: 20px;
        margin-right: 0;
    }

    .time-right {
        float: right;
        color: #aaa;
    }

    .time-left {
        float: left;
        color: #999;
    }

    .chats {
        padding: 0 10px;
        margin-top: 30px;
    }
    .wrapper {
        background: #fff;
        max-width: 1000px;
        margin: 70px auto;
        border-radius: 16px;
        box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1),
            0 32px 64px -48px rgba(0, 0, 0, 0.5);
    }

    .chats .display_chats {
        margin-top: 30px;
        height: 60vh;
        overflow-y: auto;
    }

    .wrapper .chats .header {
        font-size: 15px;
        font-weight: 600;
        padding: 20px;
        border-bottom: 1px solid #e6e6e6;
    }
    .colum-small {
        
    }
    a.notification{
        position: relative;
    }
    a.notification #showNotification{
        position: absolute;
        top: -10px;
        left: 80%;
        width: 25px;
        height: 25px;
        color: #fff;
        background: red;
        border-radius: 50%;
    }

    @media(max-width: 1200px){
        .wrapper{
         
            margin: 10px 50px;
        }
    }
</style>
<div class="container-fluid">
    <div class="column" id="column">
        <div class="colum-small">
            <div class="buttons">
                <div class="menu-list" id="menu-list">
                    <div class="profile">
                        <div class="pic-container">
                            <div class="greetings">
                                <span class="tiemIndictor"><?= timeIndicator2() ?></span>
                                <h4 class="cust-Name"><?= $fetch['Names'] ?></h4>
                            </div>
                        </div>
                    </div>
                    <ul class="list-items">
                        <li> <a href="dashboard" >USERS</a></li>
                        <li> <a href="./history.php">ACCOUNT HISTORY</a></li>
                        <li> <a href="./codes.php">BILLING CODES</a></li>
                        <li> <a href="./transfer_restrict.php">BLOCK/OPEN TRANSFER</a></li>
                        <li> <a href="./activate.php">ACTIVATE ACC</a></li>
                        <li> <a href="./chats.php" class="bg-danger">CHATS</a></li>
                        <li> <a href="./edit_profile.php">EDIT PROFILE</a></li>
                        <li> <a href="./delete_cust.php">DELETE USER</a></li>
                        <li> <a href="./sign_out.php">SIGNOUT</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="column-large" id="col-large">
            <?php
            if (isset($_GET['chatId'])) {
                $constumer = base64_decode($_GET['chatId']);
                $removeNotification = mysqli_query($conn, "UPDATE chats SET status='0' WHERE outgoing_msg_id = '$constumer'");
            ?>
                <div class="wrapper">
                    <div class="chats">
                        <a href="./chats.php">Go back</a>
                        <div class="header">
                            <h2>Chat Messages</h2>
                        </div>
                        <div class="display_chats"></div>

                        <button class="open-button" onclick="openForm()">Chat</button>

                        <div class="chat-popup" id="myForm">
                            <div id="myFormheader">Drag to move</div>
                            <form action="" class="form-containered" id="form1" method="POST">
                                <h1>Chat</h1>
                                <input type="hidden" name="outgoing_id" id="outgoing_id" value="<?= $admin_Ref ?>">
                                <input type="hidden" name="incoming_id" id="incoming_id" value="<?= $constumer ?>">
                                <label for="msg"><b>Message</b></label>
                                <textarea placeholder="Type message.." name="msg" id="msg" required></textarea>

                                <button type="sumbit" class="btn cl">Send</button>
                                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php   } else { ?>
                <form action="" method="post">
                    <p>Search Result:<?= $search ?> </p>
                    <input type="text" name="users" id="user-Search" value="<?= $search ?>" placeholder="Search Users here">
                    <button type="submit" name="search">Search</button>
                </form>
                <table class="table table-striped  table-hover" id="searchShow">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>IMAGE</th>
                            <th>USERNAME</th>
                            <th colspan='2'>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $team = $search;
                        $users = mysqli_query($conn, "SELECT * FROM OnBanking WHERE username LIKE '%$team%' AND role='customer' ORDER BY id DESC");
                        while ($row = mysqli_fetch_assoc($users)) { ?>
                            <tr>
                                <td><?= $sn++ ?></td>
                                <td><img style="width: 100px;" src="./<?= $row['image'] ?>" alt=""></td>
                                <td><?= $row['username'] ?></td>
                                <td>
                                    <a href="?chatId=<?= base64_encode($row['user_ref']) ?>" data="<?=$row['user_ref'] ?>" class='btn btn-primary notification' onclick="selectChat()">Chat With
                                        <div class="notification-container" ></div>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>

        </div>
    </div>
</div>

<script>
    const openBtn = document.querySelector('.open-button')
    const closeBtn = document.querySelector('.btn.cancel');
    openBtn.addEventListener('click', () => {
        document.getElementById("myForm").style.display = "block";
        openBtn.style.display = "none";
    })
    closeBtn.addEventListener('click', () => {
        document.getElementById("myForm").style.display = "none";
       openBtn.style.display = "block";

    })
    dragElement(document.getElementById("myForm"));
    function dragElement(elmnt) {
    var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
    if (document.getElementById(elmnt.id + "header")) {
        // if present, the header is where you move the DIV from:
        document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
    } else {
        // otherwise, move the DIV from anywhere inside the DIV:
        elmnt.onmousedown = dragMouseDown;
    }

    function dragMouseDown(e) {
        e = e || window.event;
        e.preventDefault();
        // get the mouse cursor position at startup:
        pos3 = e.clientX;
        pos4 = e.clientY;
        document.onmouseup = closeDragElement;
        // call a function whenever the cursor moves:
        document.onmousemove = elementDrag;
    }

    function elementDrag(e) {
        e = e || window.event;
        e.preventDefault();
        // calculate the new cursor position:
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;
        // set the element's new position:
        elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
        elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    }

    function closeDragElement() {
        // stop moving when mouse button is released:
        document.onmouseup = null;
        document.onmousemove = null;
    }
    }
</script>
<script src="./js/chat.js"></script>
<?php require_once './includes/dash_footer.php'; ?>