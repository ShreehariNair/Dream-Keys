const header=document.querySelector("header")

window.addEventListener("scroll", function(){
    header.classList.toggle("sticky",window.scrollY>80)
});
const params = new URLSearchParams(document.location.search);
const id = params.get("house");
console.log(id);

const request = new XMLHttpRequest();
request.addEventListener('load',function(){
    
    let property = JSON.parse(this.responseText);
    const content =  `<div class="property-tab">
    <div class="image-section">
    <video src="assets/inside-view.mp4" type="video/mp4" autoplay alt="House image" width="750" height="440" class="view-image">
    <track src="assets/subtitles.vtt" kind="subtitles" srclang="en" label="English">
    </video>
    <div class="image-preview-box">
    <img src="https://t4.ftcdn.net/jpg/03/71/92/67/240_F_371926762_MdmDMtJbXt7DoaDrxFP0dp9Nq1tSFCnR.jpg"
    width="70" height="60" alt="house image" class="preview-1">
    <img src="assets/image.png" width="70" height="60" class="active-image preview-2" alt="house-image">
    <img src="https://t4.ftcdn.net/jpg/10/07/05/19/240_F_1007051990_TsJYcKSjbFRRF2RQmcwAEk0sPDUAyUqE.jpg"
    width="70" height="60" alt="house image" class="preview-3">
    <img src="https://t3.ftcdn.net/jpg/06/39/42/46/240_F_639424665_YGf5eZXs70GJQyKRHYS51uxg4daD8LFL.jpg"
    width="70" height="60" alt="house image" class="preview-4">
    </div>
    </div>
    <div class="property-details">
    <p id="property-price">&#8377;${property[0].price}</p>
    <span class="location">
    <i class="ph ph-map-pin medium-icon"></i>${property[0].location}</span>
    <span class="beds-baths">
    <span class="beds"><i class="ph-fill ph-bed medium-icon"></i>${property[0].beds} beds</span>
    
    <span class="bath">
    <i class="ph ph-bathtub medium-icon"></i>${property[0].baths} baths</span>
    </span>
    <hr>
    <p class="about">About this home</p>
    <div class="house-features">
    <span id="sq-ft-cost"><i class="ph ph-ruler large-icon"></i>&#8377;${Math.ceil(property[0].price / property[0].size)} per sq ft</span>
    <span id="maintainance-fee"><i class="ph ph-currency-circle-dollar large-icon"></i>&#8377;1766 Monthly maintainance fee</span>
    <p class="about-line">${property[0].about}</p>
    </div>
    </div>
    <div class="property-location">
    <p class = "about"><i class="ph ph-map-pin"></i>Location
    <div id="map"></div>
    
    </p>
    </div>
    </div>`;
    
    document.querySelector('.container').insertAdjacentHTML('afterbegin',content);
    var map = L.map('map').setView([property[0].lat, property[0].longitude], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    var marker = L.marker([property[0].lat, property[0].longitude]).addTo(map);
})

window.addEventListener('load',function(){
    request.open('GET',`fetch.php?house=${id}`);
    request.send();
})

// let image = document.querySelector(".view-image");

// let preview1 = document.querySelector(".preview-1");

// let preview2 = document.querySelector(".preview-2");

// let preview3 = document.querySelector(".preview-3");

// let preview4 = document.querySelector(".preview-4");

// preview1.addEventListener("click", function () {
//   image.src = preview1.src;

//   preview1.classList.add("active-image");

//   preview2.classList.remove("active-image");

//   preview3.classList.remove("active-image");

//   preview4.classList.remove("active-image");
// });

// preview2.addEventListener("click", function () {
//   image.src = preview2.src;

//   preview2.classList.add("active-image");

//   preview1.classList.remove("active-image");

//   preview3.classList.remove("active-image");

//   preview4.classList.remove("active-image");
// });

// preview3.addEventListener("click", function () {
//   image.src = preview3.src;

//   preview3.classList.add("active-image");

//   preview1.classList.remove("active-image");

//   preview2.classList.remove("active-image");

//   preview4.classList.remove("active-image");
// });

// preview4.addEventListener("click", function () {
//   image.src = preview4.src;

//   preview4.classList.add("active-image");

//   preview1.classList.remove("active-image");

//   preview2.classList.remove("active-image");

//   preview3.classList.remove("active-image");
// });