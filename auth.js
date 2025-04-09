let isloggedIn=false;
let userEl = document.querySelector('#username');
let passwordEl = document.querySelector('#password');
let emailEl= document.querySelector('#email');
let newuserEl = document.querySelector('#user');
let pwEl = document.querySelector('#pw'); 

function validate(value){
    if(value == '' || value == 0 || value.length == 0){
        return false;
    } else {
        return true;
    }
}
function show() {
    if(!isloggedIn){
        document.getElementById('overlay').style.display="flex";
        document.querySelector('.login').style.display="flex";
        document.querySelector('.register').style.display="none";
    }
}

function hide() {
    document.getElementById('overlay').style.display="none";
    // document.querySelector('.credentials')
}

function showregister() {
    if(!isloggedIn){
        document.getElementById('overlay').style.display="flex";
        document.querySelector('.register').style.display="flex";
        document.querySelector('.login').style.display="none";
        // document.querySelector('.credentials')
    }
}
function showMessage(message="You have successfully logged out"){
    let messageContainer=document.getElementById('messageBox');
    if(!messageContainer){
        messageContainer=document.createElement('div');
        messageContainer.id='messageBox';
        messageContainer.style.cssText= 
        `position:fixed;
        bottom: 20px;
        left:50%;
        transform: translateX(-50%);
        right: 20px;
        background-color: #fff;
        color: #4caf50;
        padding: 5px 10px;
        border-radius: 8px;
        font-size: 16px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        text-align: center;
        `;
        document.body.appendChild(messageContainer);         
    }
    messageContainer.textContent=message;
    setTimeout(()=>{
        messageContainer.remove();
  },3000);
}



document.querySelector('#mybtn1').addEventListener('click',function(e){
    console.log(validate(userEl.value)); 
    validate(passwordEl.value);
    if(validate(userEl.value) && validate(passwordEl.value)){
    }
});
document.querySelector('#mybtn2').addEventListener('click',function(e){
    console.log(validate(newuserEl.value)); 
    validate(pwEl.value);
    validate(emailEl.value);
    if(validate(newuserEl.value) && validate(pwEl.value) && validate(emailEl.value)){
        
    }
});