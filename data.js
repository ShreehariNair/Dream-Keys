"use strict";
let request = new XMLHttpRequest();
let propertiesEl = document.querySelector('.properties');
let minpriceEl = document.querySelector('#price-range-input #min-price');
let maxpriceEl = document.querySelector('#price-range-input #max-price');
let roomsEl = document.querySelector('#rooms-beds-input #rooms');
let bedsEl = document.querySelector('#rooms-beds-input #beds');
let minsizeEl = document.querySelector('#size-range-input #min-size');
let maxsizeEl = document.querySelector('#size-range-input #max-size');

request.addEventListener('load',function(){
  // console.log(request.responseText);
  let properties = JSON.parse(this.responseText);
    // console.log(this.responseText);
    propertiesEl.classList.remove('flex');
    propertiesEl.innerHTML='';
    for (let property of properties) {
      
      const propertyCard = `<a href="buy.php?house=${property.property_id}"><div class="property-card">
      <svg width="24" height="24" width="40" height="90" viewBox="0 0 45 90" fill="none" class="floating-tag" xmlns="http://www.w3.org/2000/svg">
      <path d="M0 0H45V90C45 90 23.2258 78.9474 21.7742 78.9474C20.3226 78.9474 0 90 0 90V0Z" fill="#FFD700"/>
      </svg>
      
      
      <img src=${property.image_url.split('|')[0]}
      alt="property image"
      class="property-img"
      width="100"
      height="50"
          >
          <div class="property-info">
          <p class="property-name">${property.name}</p>
          <div class="owner">
            <i class="ph ph-user icon"></i>
            <p>${property.owner}</p>
            </div>
            <div class="location">
            <i class="ph ph-map-pin icon"></i>
            <p>${property.location}</p>
            </div>
            <hr>
            <div class="size">
            <i class="ph ph-arrows-out-simple icon"></i>
            <p>${property.size} sq ft</p></div>
            </div>
            </div></a>
            `
            propertiesEl.insertAdjacentHTML('beforeend',propertyCard);
          }
        })
    document.querySelector('.search-btn').addEventListener('click',function(e){
          e.preventDefault();
          const q = document.querySelector('.search-bar').value;
          const loader = `<span class="loader"></span>`;
          request.open('GET',`get_data.php?q=${q}`);
          request.send();
    })

    document.querySelector('#price-filter .done-btn').addEventListener('click',function(e){
      document.querySelector('#beds-filter').classList.add('hidden');
      document.querySelector('#size-filter').classList.add('hidden');
      document.querySelector('#price-filter').classList.add('hidden');

      console.log(e);
      e.preventDefault();
      const minprice = minpriceEl.value;
      const maxprice = maxpriceEl.value;
      minpriceEl.value = '';
      maxpriceEl.value = '';
      console.log(minprice);
      request.open('GET',`get_data.php?minprice=${Number(minprice)}&maxprice=${Number(maxprice)}`);
      request.send();

    })

    document.querySelector('#beds-filter .done-btn').addEventListener('click',function(e){
      document.querySelector('#beds-filter').classList.add('hidden');
      document.querySelector('#size-filter').classList.add('hidden');
      document.querySelector('#price-filter').classList.add('hidden');

      e.preventDefault();
      const rooms = roomsEl.value;
      const beds = bedsEl.value;
      roomsEl.value = '';
      bedsEl.value = '';
      
      request.open('GET',`get_data.php?rooms=${Number(rooms)}&beds=${Number(beds)}`);
      request.send();

    })

    document.querySelector('#size-filter .done-btn').addEventListener('click',function(e){
      document.querySelector('#beds-filter').classList.add('hidden');
      document.querySelector('#size-filter').classList.add('hidden');
      document.querySelector('#price-filter').classList.add('hidden');

      e.preventDefault();
      const minsize = minsizeEl.value;
      const maxsize = maxsizeEl.value;
      minsizeEl.value = '';
      maxsizeEl.value = '';
      request.open('GET',`get_data.php?minsize=${Number(minsize)}&maxsize=${Number(beds)}`);
      request.send();

    })
    
document.querySelector('.properties').addEventListener('click',function(e){
  console.log(e);
})

    