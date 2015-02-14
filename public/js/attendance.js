(function(){
    var attendances = document.querySelectorAll('input[data-attendance]');

    [].forEach.call(attendances, function(item){

        item.addEventListener('click', function(e){

            var url = e.target.getAttribute('data-attendance'),
            value = e.target.getAttribute('value');

            $.ajax(url + '/attend', $.serialize({status : value}), function(){
                e.target.classList.add('attendance-success');
            });
        });
    });
})();