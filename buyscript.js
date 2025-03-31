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
    let image_url = property[0].image_url.split('|');
    const content =  `<div class="property-tab">
    <div class="image-section">
    <img src=${image_url[0]} alt="House image" width="750" height="440" class="view-image">
    <div class="image-preview-box">
    <img src=${image_url[0]} width="70" height="60" alt="house image" class="preview-1">
    <img src=${image_url[1]} width="70" height="60" class="active-image preview-2" alt="house-image">
    <img src=${image_url[2]} width="70" height="60" alt="house image" class="preview-3">
    <img src=${image_url[3]} width="70" height="60" alt="house image" class="preview-4">
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
    </div>
    <div id="owner-card">
        <p id="title">Owner Details</p>
        <div class="owner-info">
          <img src="assets/owner-img.jpg" alt="Portrait of Peter Parker" class="rounded-img" width="70" height="70">
          <div class="owner-name-job">
            <p id="owner-name">${property[0].owner}</p>
          </div>
        </div>
        <div class="owner-details">
          <i class='bx bx-lock-alt XL-icon'></i>
          <span class="hidden-message">The user allows only selected users to know their details</span>
        </div>
        <form class="quotation-form">
          <input type="number" class="quotation-input">
          <button class="large-btn">Quote</button>
        </form>
      </div>
    `;
    
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