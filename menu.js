'use strict';
// let properties;


document.querySelector('.menu-btn').addEventListener('click',function(){
    document.querySelector('.mobile-nav').classList.add('open');
});
document.querySelector('.close-btn').addEventListener('click',function(){
    document.querySelector('.mobile-nav').classList.remove('open');
});

