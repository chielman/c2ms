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
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send(args);
        },
        
        serialize : function(obj) {
            var str = [];
            for(var p in obj)
                if (obj.hasOwnProperty(p)) {
                  str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                }
            return str.join("&");
        },
        
        ancestor : function(element, qs) {
            var elements = [].slice.call(document.querySelectorAll(qs)),
            compare = function(a,b){ return a.indexOf(b) !== -1; };
            
            if(compare(elements, element)){ return element; }
            
            while ((element = element.parentNode) && element.nodeType !== 9) {
                if (compare(elements, element)) {
                    return element;
                }
            }
            return false;
        },
        
        matchSelector : function(object, selector) {
            var objects = document.querySelectorAll(selector);
            return [].indexOf.call(objects, object) !== -1;
        },
    }
    
})();