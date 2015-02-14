(function(){
    var navicon = document.querySelector('.navicon'),
    menu = document.querySelector('#menu');

    // add navigation icon functionality
    navicon.addEventListener('click', function(e){
        menu.classList.toggle("hidden");
    });
    
    // if the menu is open and clicked outside of the menu, close the menu
    document.addEventListener('click', function(e){
        if (!menu.classList.contains('hidden') && !$.ancestor(e.target, '#menu, .navicon')) {
            menu.classList.add('hidden');
        }
    });
    
    // hide the menu
    menu.classList.add("hidden");
})();