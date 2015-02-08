$.editor = (function(){
    
    var _store, changed;
    
    save = function(object)
    {
        // all changes are saved
        changed = false;
    };
    
    return {
        
        setStore : function(store) {
            _store = store;
        },
        
        use : function(name, selector, type){
            var config, 
                object = document.querySelector(selector);

            object.classList.add('editor-editable');
            object.setAttribute('contentEditable', true);

            switch (type) {
                case 'single-line':
                    config = {newLine: false};
                    break;
                case 'html':
                    config = {newLine: true};
                    break;
            }

            object.addEventListener('keydown', function(e){
                // enter key
                if (e.keyCode === 13){
                    if(!config.newLine) { e.preventDefault(); return; }
                    document.execCommand('formatBlock', false, 'p');
                }
                // ctrl keys (style
                if (e.ctrlKey || e.metaKey) {
                    e.preventDefault(); return; 
                }

                changed = true;
            });
            
            object.addEventListener('paste', function(e){
                
                e.preventDefault();
                
                var text = e.clipboardData.getData('text/plain');
                
                document.execCommand('insertText', false, text);
            })

            object.addEventListener('blur', function(e){
                if (changed) {
                    // save
                    var params = [];
                    params[name] = object.innerHTML;
                    
                    $.ajax(_store, $.serialize(params), save);
                }
            });
        }
    }
})();