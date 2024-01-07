
const submitChat = document.querySelector('.chat-popup')

const msg = submitChat.querySelector('#msg')
const outgoing_id = submitChat.querySelector('#outgoing_id').value
const incoming_id = submitChat.querySelector('#incoming_id').value
const displayNewChat = document.querySelector('.display_chats')

window.onload = () => {
    //displayNewChat.scrollTo(0,1000)
    displayNewChat.scrollTop = displayNewChat.scrollHeight;
}
displayNewChat.onmouseenter = ()=>{
    displayNewChat.classList.add("active");
}

displayNewChat.onmouseleave = ()=>{
    displayNewChat.classList.remove("active");
}

async function realTimeChat(){
    let fd = new FormData();
    fd.append("outgoing_id", incoming_id);
    const showMsg = await fetch('../cust/process/display_chat.php',{
        method: 'POST',
        body: fd
    })
    console.log("fed message", fd)
    const fetchHtml = await showMsg.text();
    displayNewChat.innerHTML = fetchHtml;

    if(!displayNewChat.classList.contains("active")){
        scrollToBottom();
      }
    //displayNewChat.scrollTo(0,1000)
}

setInterval(realTimeChat, 500)
submitChat.addEventListener('submit', async (e) =>{
    e.preventDefault();
    let message_value = msg.value;

    let fd = new FormData();
    fd.append("chats", message_value);
    fd.append("outgoing_id", outgoing_id);
    fd.append("incoming_id", incoming_id);
    try {
        const response = await fetch('../cust/process/process_chat.php',{
            method: 'POST',
            body: fd
        })
     
        const data = await response.json();
        if(data.status === "success"){
            document.getElementById("form1").reset();
            realTimeChat()
        }
        
      
    } catch (error) {
        console.log("fetch error: " + error)
    }
   
   
})

function scrollToBottom(){
    displayNewChat.scrollTop = displayNewChat.scrollHeight;
  }
