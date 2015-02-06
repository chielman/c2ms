var $ = (function(){
    
    return {
        ajax : function(url, args, callback)
        {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function()
            {
                if (this.readyState === 4) {
                    callback(this);
                }
            };
            xhr.open('POST', url, true);
            xhr.send(args);
        }
    }
    
})();