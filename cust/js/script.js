// let smallCol = document.getElementById('icon-small');
// let navOpen = document.getElementById('column');
// let navList = document.getElementById('menu-list');
// let largeCol = document.getElementById('push-container');
// let bodyElement = document.querySelector('.column-large');

// function navOpened(){
//   navList.style.left = '0px';
//   largeCol.style.marginLeft = '150px';
//   smallCol.style.display = "none";
//   document.body.style.overflow = 'hidden';
// }

// bodyElement.addEventListener('click', function() {
//   var mediaQuery = window.matchMedia('(min-width: 768px)');
//   if(mediaQuery.matches){
  
//   }else{
//     navList.style.left = '-200px';
//     largeCol.style.marginLeft = '0px';
//     $("#icon-small").show();
//     smallCol.style.display = "block";
//     document.body.style.overflow = 'scroll';
//   }
  
// });
// let removeBtn = document.querySelector('.account-display');
//   removeBtn.addEventListener('click', function() {
//     var mediaQuery = window.matchMedia('(min-width: 768px)');
//     if(mediaQuery.matches){
    
//     }else{
//       navList.style.left = '-200px';
//       largeCol.style.marginLeft = '0px';
//       $("#icon-small").show();  
//       smallCol.style.display = "block";
//       document.body.style.overflow = 'scroll';
//     }
    
//   });

let fileUpload = document.getElementById('dpUploaded');
const preview = document.getElementById('uploadForm');

const notifications = document.querySelectorAll('.showNotify')
const messages = document.querySelector('.messages');
const popNotifications = document.querySelector('ul.first .notify')

// fetch notification
const fetchNotification = async () => {
  const response = await fetch('./process/notification.php')
  const data = await response.text();
  notifications.forEach(notification => {
    notification.innerHTML = data

  })  

  const notify = messages.querySelector('.showNotify')
  const badge = notify.querySelector('.badge')
  notify.removeChild(badge)

  const popContainer = popNotifications.querySelector('.showNotify')
  const otherBadge = popContainer.querySelector('.badge')
  popContainer.removeChild(otherBadge)
 
 
}

// api call
setInterval(fetchNotification, 500)


function openFile(){
  fileUpload.click();
}
function showPhoto(input) {
  if(fileUpload.value === ""){

  }else{
    $("#uploadForm").fadeIn();
  }
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#preview')
        .attr('src', e.target.result);
        // .width(150);
        // .height(200);
    };
    reader.readAsDataURL(input.files[0]);
  }
}
