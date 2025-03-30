const header=document.querySelector("header")

window.addEventListener("scroll", function(){
    header.classList.toggle("sticky",window.scrollY>80)
});

//Media Queries Hamburger Menu
const menuIcon=document.querySelector("#menu-icon");
const navbar=document.querySelector(".navbar");

menuIcon.addEventListener("click",()=>{
    navbar.classList.toggle("active");
});