$.editor = (function(){
    
    var _store, changed;
    
    save = function(object)
    {
        // all changes are saved
        changed = false;
    },
    editable = function(name, object, config)
    {
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
        });

        object.addEventListener('blur', function(e){
            if (changed) {
                // save
                var params = [];
                params[name] = object.innerHTML;

                $.ajax(_store, $.serialize(params), save);
            }
        });
    },
    mediable = function(name, object)
    {
        var preview = function(file) {
            var reader = new FileReader();
            reader.onload = function(e){
                object.src = e.target.result;
            };
            reader.readAsDataURL(file);
        };
        
        object.addEventListener('drop', function(e){
            
            e.preventDefault();
            
            var formData = new FormData(), files = e.dataTransfer.files;
            
            for (var i = 0; i < files.length; i++) {
                
                formData.append('file', files[i]);
                // add preview for upload
                preview(files[i]);
            }
        });
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
                case 'media':
                    mediable(name, object);
                    break;
                case 'single-line':
                    config = {newLine: false};
                    editable(name, object, config);
                    break;
                case 'html':
                    config = {newLine: true};
                    editable(name, object, config);
                    break;
            }
        }
    }
})();