const ulSettings = document.querySelectorAll('ul.settings a');
const contents = document.querySelectorAll('form.content')
let passwordContainer = document.querySelector('.general-settings-container')
const toggleBeneficiaryBtn = document.querySelectorAll('.same-ben')
const toggleSelect = document.querySelectorAll('.select-ben')

// sidabar As
const allAs = document.querySelectorAll('.grid-1 a')
// 



// cards
const visa = document.querySelector('.card-col.visa')
const master = document.querySelector('.card-col.master')

const forward_ang = document.querySelector('.right')
const backward_ang = document.querySelector('.left');

toggleBeneficiaryBtn.forEach(button => {
    button.addEventListener('click', (e) => {
        toggleBeneficiaryBtn.forEach(btn=>{btn.classList.remove('active')})
        e.target.classList.add('active')
        toggleSelect.forEach(select => {select.classList.remove('active')})
        const attributes = e.target.getAttribute('data-list');
        document.querySelector(attributes).classList.add('active')
    })
});

// sidebrbar toggle button
let urlArray = window.location.pathname.split('/');
let pagAtual =urlArray[urlArray.length -1];
allAs.forEach(a => {
  const content = a.getAttribute('href')
  a.classList.remove('dash-active')
  if(content === pagAtual){
      a.classList.add('dash-active')
  }
})

// update password and pin tabs toggles
ulSettings.forEach(list => {
    list.addEventListener('click',e => {
        e.preventDefault();
        ulSettings.forEach(li => {
            li.classList.remove('active');
        })
        contents.forEach(content => {
            content.classList.remove('active');
            
        })
        if(e.target.tagName === 'A'){
           let targeted = e.target
           targeted.classList.add('active');
           const attribute = targeted.getAttribute("data-info")
           let activContent = passwordContainer.querySelector(attribute)
           activContent.classList.add('active')
        }
        
    })
})

// show password
function functionShow() {
    let passInput = document.getElementById("pass2");
    let passInput2 = document.getElementById("pass1");
    if(passInput.type =="password"){
        passInput.type = "text";
    }else{
        passInput.type = "password";    
    }
    if(passInput2.type =="password"){
        passInput2.type = "text";
    }else{
        passInput2.type = "password";    
    }
}
function functionShowPin() {
    let passInput = document.getElementById("pass3");
    let passInput2 = document.getElementById("pass4");
    if(passInput.type =="password"){
        passInput.type = "text";
    }else{
        passInput.type = "password";    
    }
    if(passInput2.type =="password"){
        passInput2.type = "text";
    }else{
        passInput2.type = "password";    
    }
}


// Navbar open and close buttons
const row = document.querySelector('.row');
const open = document.querySelector('.open');
open.addEventListener('click', (e) =>{
    const imgAt = e.target.getAttribute('src');
    if(imgAt === './dash-img/menu.svg') {
        e.target.setAttribute('src','./dash-img/closed.svg')
    }else{
    e.target.setAttribute('src','./dash-img/menu.svg')
    }
    row.classList.toggle('activate-open');
    
});

// Navbar media query watch events
const checkMedia = function(x){
    if(x.matches){
        row.classList.remove('activate-open')
        open.setAttribute('src','./dash-img/menu.svg')
    }
}
let x = window.matchMedia("(min-width: 1100px)")
checkMedia(x)
x.addListener(checkMedia)


// cards switching starts here
forward_ang.addEventListener('click', (e) => {
    visa.classList.add('remove-visa');
    master.classList.add('active')
    visa.classList.remove('active');
    backward_ang.disabled = false;
    forward_ang.disabled = true;
})
backward_ang.addEventListener('click', (e) => {
    master.classList.add('remove-master');
    visa.classList.add('active');
    master.classList.remove('active');
    backward_ang.disabled = true;
    forward_ang.disabled = false;
})
// cards switching ends here

// card activatation switch starts here
const activates = document.querySelectorAll('.container.switcher')
activates.forEach(activate =>{
    activate.addEventListener('click', (e) => {
        if(e.target.classList.contains('switch')){
            e.target.classList.toggle('activate-switch')
            activate.classList.toggle('container-color')
        }
    })
})
// card activation switch ends here


// popup chat starts here
function openForm() {
    document.getElementById("myForm").style.display = "block";
  }
  
  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  } 

