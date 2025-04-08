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
function validate(value){
  if(value == '' || value == 0 || value.length == 0){
    return false;
  } else {
    return true;
  }
}
function validatePhone(phone){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Invalid Phone Number</p>
  </div>`;
  let errorEl = document.querySelector('#phone-container .error');

  if(phone.length != 10){
    if(!document.querySelector('#phone-container').contains(errorEl)){
      document.querySelector('#phone-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else {
    return true;
  }
}

function validateEmail(email){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Invalid Email</p>
  </div>`;
  let errorEl = document.querySelector('#email-container .error');

  if(!(email.includes('@') && email.includes('.com'))){
    if(!document.querySelector('#email-container').contains(errorEl)){
      document.querySelector('#email-container').insertAdjacentHTML('beforeend',error)
    }
    return false;
  } else {
    return true;
  }
}

function validatePincode(pincode){
  const error = `<div class = "error">
  <i class="ph ph-warning"></i>
  <p>Invalid Pincode</p>
  </div>`;
  let errorEl = document.querySelector('#email-container .error');

  if(pincode.length != 6){
    if(!document.querySelector('#pincode-container').contains(errorEl)){
      document.querySelector('#pincode-container').insertAdjacentHTML('beforeend',error);
    }
    document.querySelector('#pincode-container').insertAdjacentHTML('beforeend',error);
    return false;
  } else {
    return true;
  }
}
phoneEl.addEventListener('input',validatePhone(phoneEl.value));

document.querySelector('#form-1-btn').addEventListener('click',function(e){

owner.firstName = firstNameEl.value;
owner.lastName = lastNameEl.value;
owner.fullName = owner.firstName + ' ' + owner.lastName;
owner.email = emailEl.value;
owner.phone = Number(phoneEl.value); 

validatePhone(phoneEl.value);
validateEmail(emailEl.value);

  if(validatePhone(phoneEl.value) && validateEmail(emailEl.value) && validate(firstNameEl.value) && validate(lastNameEl.value)){
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

    if(validate(carpetAreaEl.value) && validate(builtYearEl.value) && validate(bathsEl.value) && validate(bedsEl.value) && validate(priceEl.value)){
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
  if(imageEl.value){
  property.image_url.push(imageEl.value);
  imageEl.value = '';
  } 
  if(videoEl.value){
    property.video_url = videoEl.value;
    videoEl.value = ''
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
     if(validate(property.image_url)){
      
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
  
  if(validate(addressEl.value) && validatePincode(pincodeEl.value) && validate(streetEl.value) && validate(cityEl.value) && validate(latEl.value) && validate(longEl.value) && validate(stateEl.value)){
    e.preventDefault();
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