

document.querySelector('#price-filter-btn').addEventListener('click',function(){
    document.querySelector('#price-filter').classList.toggle('hidden');
    document.querySelector('#beds-filter').classList.add('hidden');
    document.querySelector('#size-filter').classList.add('hidden');

})

document.querySelector('#beds-filter-btn').addEventListener('click',function(){
    document.querySelector('#beds-filter').classList.toggle('hidden');
    document.querySelector('#price-filter').classList.add('hidden');
    document.querySelector('#size-filter').classList.add('hidden');

})

document.querySelector('#size-filter-btn').addEventListener('click',function(){
    document.querySelector('#size-filter').classList.toggle('hidden');
    document.querySelector('#price-filter').classList.add('hidden');
    document.querySelector('#beds-filter').classList.add('hidden');

})

