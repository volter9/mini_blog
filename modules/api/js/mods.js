(function () {
    /**
     * WYSIWIG buttons mod
     * 
     * @param {mini_blog.editor} editor
     */
    var WysiwigMod = function (editor) {
        mini_blog.mod.call(this, editor);
    };
    
    WysiwigMod.prototype = Object.create(mini_blog.mod.prototype);
    
    /**
     * Initiate WYSIWIG actions:
     * 
     * - Bold
     * - Italic
     * - Blockquote
     * - Header
     * - Code (block)
     */
    WysiwigMod.prototype.init = function () {
        var self = this;
        
        this.name = 'wysiwig';
        
        this.addAction('header', '<i class="fa fa-header fa-fw"></i>', function () {
            document.execCommand('formatBlock', null, 'h1');
        });
        
        this.addAction('bold', '<i class="fa fa-bold fa-fw"></i>', function () {
            document.execCommand('bold');
        });
        
        this.addAction('italic', '<i class="fa fa-italic fa-fw"></i>', function () {
            document.execCommand('italic');
        });
        
        this.addAction('link', '<i class="fa fa-link fa-fw"></i>', function () {
            var isLink = !mini_blog.dom.hasParent(document.getSelection().anchorNode, function (node) {
                return node.nodeName.toLowerCase() === 'a';
            });
            
        	if (isLink) {
        	    var link = window.prompt('Enter the link', '');
        	    
                document.execCommand('createLink', false, link);
            }
            else {
                document.execCommand('unlink');
            }
        });
        
        this.addAction('image', '<i class="fa fa-picture-o fa-fw"></i>', function () {
            var url = window.prompt('Enter image URL:', '');
            
            document.execCommand('insertImage', null, url);
        });
        
        this.addAction('quote', '<i class="fa fa-quote-right fa-fw"></i>', function () {
            document.execCommand('formatBlock', null, 'blockquote');
        });
        
        this.addAction('paragraph', '<i class="fa fa-paragraph fa-fw"></i>', function () {
            document.execCommand('formatBlock', null, 'p');
            
            var selection = document.getSelection(),
                p = selection.anchorNode.parentNode;
            
            if (p.nodeName !== 'P') {
                p = p.parentNode;
            }
            
            p.innerHTML = p.innerText || p.textContent;
        });
        
        this.addAction('code', '<i class="fa fa-code fa-fw"></i>', function () {
            document.execCommand('formatBlock', null, 'pre');
        });
        
        this.addAction('ul-list', '<i class="fa fa-list-ul fa-fw"></i>', function () {
            document.execCommand('insertUnorderedList');
        });
        
        this.addAction('ol-list', '<i class="fa fa-list-ol fa-fw"></i>', function () {
            document.execCommand('insertOrderedList');
        });
    };
    
    /**
     * Register all mods and enable edit mod **only**
     */
    mini_blog.panel.addMod('wysiwig', new WysiwigMod(mini_blog.panel));
    
    mini_blog.panel.disableMods();
})();