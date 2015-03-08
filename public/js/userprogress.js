(function(){
    
    // add new report button
    var button = document.querySelector('#report_add');

    if (!button){ return; }
    
    button.addEventListener('click', function(){
        
        var selector = document.querySelector('#report_type');
        if (!selector){ return; }
        
        var type = selector.value;
        
        $.ajax(url + '/add', $.serialize({type : type}), function(data){
            var parent = $.ancestor(button, '.report').parentNode,
            reports = document.createElement('div');
            reports.innerHTML = data.html;
            parent.appendChild(reports.firstChild);
        });
    });
    
    // support editing

})();