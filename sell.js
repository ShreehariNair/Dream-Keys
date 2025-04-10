const header=document.querySelector("header")

window.addEventListener("scroll", function(){
    header.classList.toggle("sticky",window.scrollY>80)
});

let container1 = document.querySelector('.container-1');
let container2 = document.querySelector('.container-2');
let container3 = document.querySelector('.container-3');
let container4 = document.querySelector('.container-4');
let firstNameEl = document.querySelector('#first-name');
let lastNameEl = document.querySelector('#last-name');
let emailEl = document.querySelector('#email');
let phoneEl = document.querySelector('#phone');
let houseEl = document.querySelector('#house');
let carpetAreaEl = document.querySelector('#sqft');
let builtYearEl = document.querySelector('#built-year');
let bathsEl = document.querySelector('#baths');
let bedsEl = document.querySelector('#bedrooms');
let imageEl = document.querySelector('#image-url');
let videoEl = document.querySelector('#video-url');
let priceEl = document.querySelector('#price');

let addressEl = document.querySelector('#address');
let pincodeEl = document.querySelector('#pincode');
let streetEl = document.querySelector('#street');
let cityEl = document.querySelector('#city');
let latEl = document.querySelector('#lat');
let longEl = document.querySelector('#long');
let stateEl = document.querySelector('#state');
let aboutEl =document.querySelector('#about');
let image_url = [];

let owner = {
  firstName: "",
  lastName: "",
  email: "",
  phone: 0
};
let property = {
  type:"Sale",
  size:0,
  builtYear:0,
  owner,
  baths: 0,
  beds:0,
  image_url,
  video_url:'',
  address: "",
  zipcode: 0,
  street: "",
  city: "",
  lat: 0.0,
  long: 0.0,
  state: "",
  about:"",
  transaction:"Sale",
  price: 0
};

const request = new XMLHttpRequest();

request.addEventListener('load',function(){
  let x = this.responseText;
  console.log(x);
});
function validateFirstName(){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Enter a valid name</p>
  </div>`;
  let errorEl = document.querySelector('#first-name-container .error');
  const pattern = /[1-9-’/`~!#*$@_%+=.,^&(){}[\]|;:”<>?\\]/g;

  if(firstNameEl.value == '' ){
    if(!errorEl){
      document.querySelector('#first-name-container').insertAdjacentHTML('beforeend',error)
      return false;
    }
  } else if(firstNameEl.value.match(pattern)) {
    if(!errorEl){
      document.querySelector('#first-name-container').insertAdjacentHTML('beforeend',error)
      return false;
    }
  } else {
    if(document.querySelector('#first-name-container').contains(errorEl)){
      errorEl.remove();
    }
    return true;
  }
}

function validateLastName(){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Enter a valid name</p>
  </div>`;
  let errorEl = document.querySelector('#last-name-container .error');
  const pattern = /[1-9-’/`~!#*$@_%+=.,^&(){}[\]|;:”<>?\\]/g;

  if(lastNameEl.value == '' ){
    if(!errorEl){
      document.querySelector('#last-name-container').insertAdjacentHTML('beforeend',error)
      return false;
    }
  } else if(lastNameEl.value.match(pattern)) {
    if(!errorEl){
      document.querySelector('#last-name-container').insertAdjacentHTML('beforeend',error)
      return false;
    }
  } else {
    if(document.querySelector('#last-name-container').contains(errorEl)){
      errorEl.remove();
    }
    return true;
  }
};

function validatePhone(){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Invalid Phone Number</p>
  </div>`;
  let errorEl = document.querySelector('#phone-container .error');
  const pattern = /[-’/`~!#*$@_%+=.,^&(){}[\]|;:”<>?\\]/g;
  if(phoneEl.value.length != 10 ){
    if(!errorEl){
      document.querySelector('#phone-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else if(phoneEl.value.match(pattern)) {
    if(!errorEl){
      document.querySelector('#phone-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else {
    if(document.querySelector('#phone-container').contains(errorEl)){
      errorEl.remove();
    }
    return true;
  }
}

function validateEmail(){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Invalid Email</p>
  </div>`;
  let errorEl = document.querySelector('#email-container .error');
  if(emailEl.value.length == 0){
    if(!document.querySelector('#email-container').contains(errorEl)){
      document.querySelector('#email-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
}else if(!(emailEl.value.includes('@'))){
    if(!document.querySelector('#email-container').contains(errorEl)){
      document.querySelector('#email-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else if(!emailEl.value.includes('.com')){
    if(!document.querySelector('#email-container').contains(errorEl)){
      document.querySelector('#email-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else {
    if(document.querySelector('#email-container').contains(errorEl)){
      errorEl.remove();
    }
    return true;

  }
}

function validatePincode(){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Invalid Pincode</p>
  </div>`;
  let errorEl = document.querySelector('#pincode-container .error');

  if(pincodeEl.value.length != 6){
    if(!document.querySelector('#pincode-container').contains(errorEl)){
      document.querySelector('#pincode-container').insertAdjacentHTML('beforeend',error);
    }
    document.querySelector('#pincode-container').insertAdjacentHTML('beforeend',error);
    return false;
  } else if(pincodeEl.value.match(/[a-zA-z]/g)){
    if(!document.querySelector('#pincode-container').contains(errorEl)){
      document.querySelector('#pincode-container').insertAdjacentHTML('beforeend',error);
    }
    document.querySelector('#pincode-container').insertAdjacentHTML('beforeend',error);
    return false;
  } else {
    if(document.querySelector('#pincode-container').contains(errorEl)){
      errorEl.remove();
    }
    return true;
  }
}

function validateArea(){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Invalid Carpet Area (Minimum 200)</p>
  </div>`;
  let errorEl = document.querySelector('#sqft-container .error');
  const pattern = /[-’/`~!#*$@_%+=.,^&(){}[\]|;:”<>?\\]/g;
  if(carpetAreaEl.value.length == 0){
    if(!errorEl){
      document.querySelector('#sqft-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else if(carpetAreaEl.valueAsNumber < 200){
    if(!errorEl){
      document.querySelector('#sqft-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else if(carpetAreaEl.value.match(pattern)){
    if(!errorEl){
      document.querySelector('#sqft-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  }
  else {
    if(document.querySelector('#sqft-container').contains(errorEl)){
      errorEl.remove();
    }
    return true;
  }
}



function validateRooms(){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Invalid number(Maximum 6)</p>
  </div>`;
  let errorEl = document.querySelector('#beds-container .error');
  const pattern = /[-’/`~!#*$@_%+=.,^&(){}[\]|;:”<>?\\]/g;
  if(bedsEl.value.length == 0){
    if(!errorEl){
      document.querySelector('#beds-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else if (bedsEl.valueAsNumber < 0) {
    if (!errorEl) {
      document.querySelector('#beds-container').insertAdjacentHTML('beforeend', error);
    }
    return false;
  } else if (bedsEl.valueAsNumber > 6) {
    if (!errorEl) {
      document.querySelector('#beds-container').insertAdjacentHTML('beforeend', error);
    }
    return false;
  } else if (bedsEl.value.match(pattern)) {
    if (!errorEl) {
      document.querySelector('#beds-container').insertAdjacentHTML('beforeend', error);
    }
    return false;
  } else {
    if(document.querySelector('#beds-container').contains(errorEl)){
      errorEl.remove();
    }
    return true;
  }
}

function validateBaths(){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Invalid number(Maximum 6)</p>
  </div>`;
  let errorEl = document.querySelector('#baths-container .error');
  const pattern = /[-’/`~!#*$@_%+=.,^&(){}[\]|;:”<>?\\]/g;
  if(bathsEl.value.length == 0){
    if(!errorEl){
      document.querySelector('#baths-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  }else if (bathsEl.valueAsNumber < 0) {
    if (!errorEl) {
      document.querySelector('#baths-container').insertAdjacentHTML('beforeend', error);
    }
    return false;
  } else if (bathsEl.valueAsNumber > 6) {
    if (!errorEl) {
      document.querySelector('#baths-container').insertAdjacentHTML('beforeend', error);
    }
    return false;
  }else if (bathsEl.value.match(pattern)) {
    if (!errorEl) {
      document.querySelector('#baths-container').insertAdjacentHTML('beforeend', error);
    }
    return false;
  } else {
    if(document.querySelector('#baths-container').contains(errorEl)){
      errorEl.remove();
    }
    return true;
  }
}

function validatePrice(){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Price should be atleast 50000</p>
  </div>`;
  let errorEl = document.querySelector('#price-container .error');
  const pattern = /[-’/`~!#*$@_%+=.,^&(){}[\]|;:”<>?\\]/g;
  if(priceEl.value.length == 0){
    if(!errorEl){
      document.querySelector('#price-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else if (priceEl.value.match(pattern)) {
    if (!errorEl) {
      document.querySelector('#price-container').insertAdjacentHTML('beforeend', error);
    }
    return false;
  } else if (priceEl.valueAsNumber < 50000) {
    if (!errorEl) {
      document.querySelector('#price-container').insertAdjacentHTML('beforeend', error);
    }
    return false;
  } else {
    if(document.querySelector('#price-container').contains(errorEl)){
      errorEl.remove();
    }
    return true;
  }
}
function validateYear(){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Invalid Year</p>
  </div>`;
  let errorEl = document.querySelector('#built-container .error');
  const pattern = /[-’/`~!#*$@_%+=.,^&(){}[\]|;:”<>?\\]/g;
  if(builtYearEl.value.length != 4){
    if(!errorEl){
      document.querySelector('#built-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else if (builtYearEl.value.match(pattern)) {
    if (!errorEl) {
      document.querySelector('#built-container').insertAdjacentHTML('beforeend', error);
    }
    return false;
  }else if (builtYearEl.valueAsNumber < 1940) {
    if (!errorEl) {
      document.querySelector('#built-container').insertAdjacentHTML('beforeend', error);
    }
    return false;
  } else {
    if(document.querySelector('#built-container').contains(errorEl)){
      errorEl.remove();
    }
    return true;
  }
}

function validateURL(){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Invalid URL</p>
  </div>`;
  let errorEl = document.querySelector('#image-container .error');
  if(imageEl.value.length == 0){
    if(!errorEl){
      document.querySelector('#image-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else {
    if(document.querySelector('#image-container').contains(errorEl)){
      errorEl.remove();
    }
    return true;
  }
}

function validateAddress(){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Invalid Address</p>
  </div>`;
  let errorEl = document.querySelector('#address-container .error');
  const pattern = /[-’/`~!#*$@_%+=^&(){}[\]|;:”<>?\\]/g;
  if(addressEl.value.length == 0){
    if(!errorEl){
      document.querySelector('#address-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else {
    if(document.querySelector('#address-container').contains(errorEl)){
      errorEl.remove();
    }
    return true;
  }
}

function validateStreet(){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Invalid Street</p>
  </div>`;
  let errorEl = document.querySelector('#street-container .error');
  const pattern = /[-’/`~!#*$@_%+=^&(){}[\]|;:”<>?\\]/g;
  if(streetEl.value.length == 0){
    if(!errorEl){
      document.querySelector('#street-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else if(streetEl.value.match(pattern)){
    if(!errorEl){
      document.querySelector('#street-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else {
    if(document.querySelector('#street-container').contains(errorEl)){
      errorEl.remove();
    }
    return true;
  }
}
function validateCity(){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Invalid City</p>
  </div>`;
  let errorEl = document.querySelector('#city-container .error');
  const pattern = /[-’/`~!#*$@_%+=^&(){}[\]|;:”<>?\\]/g;
  if(cityEl.value.length == 0){
    if(!errorEl){
      document.querySelector('#city-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else if(cityEl.value.match(pattern)){
    if(!errorEl){
      document.querySelector('#city-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else {
    if(document.querySelector('#city-container').contains(errorEl)){
      errorEl.remove();
    }
    return true;
  }
}
function validateState(){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Invalid State</p>
  </div>`;
  let errorEl = document.querySelector('#state-container .error');
  const pattern = /[-’/`~!#*$@_%+=^&(){}[\]|;:”<>?\\]/g;
  if(stateEl.value.length == 0){
    if(!errorEl){
      document.querySelector('#state-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else if(stateEl.value.match(pattern)){
    if(!errorEl){
      document.querySelector('#state-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  }else {
    if(document.querySelector('#state-container').contains(errorEl)){
      errorEl.remove();
    }
    return true;
  }
}

function validateAbout(){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Enter minimum 200 characters</p>
  </div>`;
  let errorEl = document.querySelector('#about-container .error');
  const pattern = /[-’/`~!#*$@_%+=^&(){}[\]|;:”<>?\\]/g;
  if(aboutEl.value.length == 0){
    if(!errorEl){
      document.querySelector('#about-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else if(aboutEl.value.length < 100){
    if(!errorEl){
      document.querySelector('#about-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  }else {
    if(document.querySelector('#about-container').contains(errorEl)){
      errorEl.remove();
    }
    return true;
  }
}

function validateLat(){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Enter valid latitude</p>
  </div>`;
  let errorEl = document.querySelector('#lat-container .error');
  const pattern = /[a-zA-z-’/`~!#*$@_%+=^&(){}[\]|;:”<>?\\]/g;
  if(latEl.value.length == 0){
    if(!errorEl){
      document.querySelector('#lat-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else {
    if(document.querySelector('#lat-container').contains(errorEl)){
      errorEl.remove();
    }
    return true;
  }
}

function validateLong(){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Enter valid longitude</p>
  </div>`;
  let errorEl = document.querySelector('#long-container .error');
  const pattern = /[a-zA-z-’/`~!#*$@_%+=^&(){}[\]|;:”<>?\\]/g;
  if(longEl.value.length == 0){
    if(!errorEl){
      document.querySelector('#long-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else {
    if(document.querySelector('#long-container').contains(errorEl)){
      errorEl.remove();
    }
    return true;
  }
}
phoneEl.addEventListener('change',validatePhone);
emailEl.addEventListener('change',validateEmail);
firstNameEl.addEventListener('change',validateFirstName);
lastNameEl.addEventListener('change',validateLastName);
carpetAreaEl.addEventListener('change',validateArea);
bedsEl.addEventListener('change',validateRooms);
bathsEl.addEventListener('change',validateBaths);
priceEl.addEventListener('change',validatePrice);
builtYearEl.addEventListener('change',validateYear);
imageEl.addEventListener('change',validateURL);
addressEl.addEventListener('change',validateAddress);
stateEl.addEventListener('change',validateState);
cityEl.addEventListener('change',validateCity);
streetEl.addEventListener('change',validateStreet);
aboutEl.addEventListener('change',validateAbout);
latEl.addEventListener('change',validateLat);
longEl.addEventListener('change',validateLong);


document.querySelector('#form-1-btn').addEventListener('click',function(e){

  owner.firstName = firstNameEl.value;
  owner.lastName = lastNameEl.value;
  owner.fullName = owner.firstName + ' ' + owner.lastName;
  owner.email = emailEl.value;
  owner.phone = Number(phoneEl.value); 
  
  
  if(validatePhone() && validateEmail() && validateFirstName() && validateLastName()){
    e.preventDefault();
    firstNameEl.value = '';
    lastNameEl.value = '';
    emailEl.value = '';
    phoneEl.value = '';
    container1.classList.add("hidden");
    container2.classList.remove("hidden");  
  }
  
})

document.querySelector('#form-2-btn').addEventListener('click',function(e){
    property.type = houseEl.value;
    property.size = Number(carpetAreaEl.value);
    property.builtYear = Number(builtYearEl.value);
    property.baths = Number(bathsEl.value);
    property.beds = Number(bedsEl.value);
    property.price = Number(priceEl.value);

    if(validateArea() && validateRooms() && validateBaths() && validatePrice() && validateYear()){
    e.preventDefault();
    houseEl.value = '';
    carpetAreaEl.value = '';
    builtYearEl.value = '';
    bathsEl.value = '';
    bedsEl.value = '';
    priceEl.value = '';
    container2.classList.add("hidden");
    container3.classList.remove("hidden");  
    }})

document.querySelector('.upload-btn').addEventListener('click',function(e){
  e.preventDefault();
  if(validateURL()){
  property.image_url.push(imageEl.value);
  imageEl.value = '';
  } 
  document.querySelector('.images-preview').innerHTML = '';
    if(image_url.length){
      for (image of image_url){
        const smallImage = `<img class="small-img" src="${image}" width="32" height="32">`
        document.querySelector('.images-preview').insertAdjacentHTML('beforeend',smallImage);
      }
    }
    });
document.querySelector('#form-3-btn').addEventListener('click',function(e){
  e.preventDefault();
     if(property.image_url.length == 4){
      
       container3.classList.add("hidden");
       container4.classList.remove("hidden"); 
     } else {
      const error = `<div class = "error">
      <i class="ph ph-warning"></i>
      <p>Please upload some images</p>
      </div>`;
      document.querySelector('.images-preview').insertAdjacentHTML('beforeend',error)
     }
    });

document.querySelector('#form-4-btn').addEventListener('click',function(e){
  property.address = addressEl.value;
  property.zipcode = Number(pincodeEl.value);
  property.street = streetEl.value;
  property.city = cityEl.value;
  property.lat = Number(latEl.value);
  property.long = Number(longEl.value);
  property.state = stateEl.value;
  property.about = aboutEl.value;
  e.preventDefault();
  
  if(validateAbout() && validateAddress() && validateCity() && validateLat() && validateLong() && validatePincode() && validateState() && validateStreet()){
    addressEl.value = '';
    pincodeEl.value = '';
    cityEl.value = '';
    latEl.value = '';
    longEl.value = '';
    stateEl.value = '';
    aboutEl.value = '';
    container4.classList.add("hidden");
    
      request.open("POST",'post.php');
      request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      request.send(`property=${JSON.stringify(property)}`);
      document.querySelector('main').insertAdjacentHTML('beforeend',`<div class="upload-status-msg">
      <i class="ph-fill ph-seal-check check-icon" ></i>
        <p class="primary-msg">Property successfully uploaded</p>
        <p class="secondary-msg">Property will shortly be visible to public</p>
      </div>`)
  }
    
})