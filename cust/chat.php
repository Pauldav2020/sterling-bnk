<?php
require_once './includes/new_header.php';
include './sideHeight.php';

$admin_Ref = 'REG-1027021';

 
if(isset($_GET['notification'])){
        $clearNotification = mysqli_query($conn, "UPDATE chats SET status='0' WHERE incoming_msg_id='$user_Ref' AND status='1'");
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
        position: absolute;
        bottom: 0;
        right: 15px;
        /* border: 3px solid #f1f1f1; */
        z-index: 99;
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
    }
    .wrapper{
        background: #fff;
        max-width: 1000px;
        margin: 20px auto;
        border-radius: 16px;
        box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1),
            0 32px 64px -48px rgba(0, 0, 0, 0.5);
    }
    .chats .display_chats {
        margin-top: 30px;
        height: 50vh;
        overflow-y: auto;
    }
    .wrapper .chats .header{
        font-size: 15px;
        font-weight: 600;
        padding: 20px;
        border-bottom: 1px solid #e6e6e6;
    }
    @media(max-width: 1200px){
        .wrapper{
         
            margin: 10px 50px;
        }
    }
</style>
<div class="wrapper">
    <div class="chats">
        <div class="header">
            <h2>Chat Messages</h2>
        </div>
        <div class="display_chats">


        </div>
        <button class="open-button" onclick="openForm()">Chat</button>
        <div class="chat-popup" id="myForm">
            <div id="myFormheader">Drag to move</div>
            <form action="" class="form-containered" id="form1" method="POST">
                <h1>Chat</h1>
                <input type="text" name="outgoing_id" id="outgoing_id" value="<?=$user_Ref ?>" hidden>
                <input type="text" name="incoming_id" id="incoming_id" value="<?=$admin_Ref ?>" hidden>
                <label for="msg"><b>Message</b></label>
                <textarea placeholder="Type message.." name="msg" id="msg" class="" required></textarea>

                <button type="sumbit" class="btn cl">Send</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>
        </div>
    
    </div>
</div>
<!-- <script type="text/javascript">
  $( document ).ready(function() {
   
    let page = '';
    var urlArray = window.location.pathname.split('/');
    var pagAtual =urlArray[urlArray.length -1];
    $("a[href*='+pagAtual+']").addClass('dash-active');
    page = pagAtual
    console.log("page is", urlArray, pagAtual)

    const ases = document.querySelectorAll('.grid-1 a')
  ases.forEach(a => {
    const content = a.getAttribute('href')
    a.classList.remove('dash-active')
    if(content === page){
        a.classList.add('dash-active')
        console.log("content is", a)
      
    }
  })
  });

  
</script> -->
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
<script src="./js/chats.js"></script>
<?php require_once './includes/new_footer.php' ?>