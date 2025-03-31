const header=document.querySelector("header")

window.addEventListener("scroll", function(){
    header.classList.toggle("sticky",window.scrollY>80)
});

// Video Javascript
document.addEventListener("DOMContentLoaded",function(){
    const video=document.getElementById("myvideo");
    video.play();
video.addEventListener("mouseenter",function(){
    video.play();
});
video.addEventListener("mouseleave", function () {
    video.pause(); 
  });
});
//Media Queries Hamburger Menu
const menuIcon=document.querySelector("#menu-icon");
const navbar=document.querySelector(".navbar");

menuIcon.addEventListener("click",()=>{
    navbar.classList.toggle("active");
});