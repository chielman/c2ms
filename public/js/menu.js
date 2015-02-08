//klik op navicon - menu verschijnt eerst display:none; dan display:absolute;

var navicon = document.querySelector('.navicon');
var menu = document.querySelector('#menu');
navicon.addEventListener('click', function(e){
    menu.classList.toggle("hidden");
});
menu.classList.add("hidden");