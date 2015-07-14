/**
 * Admin panel
 */
mini_blog.panel = (function () {
    /**
     * @param {Node} node
     */
    function Panel (node) {
        this.node = node;
        
        var self = this,
            add  = node.querySelector('.add');
        
        add.addEventListener('click', function () {
            if (!mini_blog.editor.active) {
                self.createNode(self.item, self.destination);
            }
        });
    }
    
    /**
     * Create a node from template requested via AJAX
     * 
     * @param {String} item
     * @param {Node} destination
     */
    Panel.prototype.createNode = function (item, destination) {
        var url = ['admin', 'template', 'posts'];
        
        mini_blog.ajax.post(url)
                      .success(this.addNode.bind(this))
                      .send();
    };
    
    /**
     * Add a node, this function serves as callback
     * 
     * @param {XMLHttpRequest} xhr
     * @param {Object} data
     */
    Panel.prototype.addNode = function (xhr, data) {
        var empty = document.querySelector('.posts .empty');
        
        if (empty) {
            empty.parentNode.removeChild(empty);
        }
        
        var fragment    = document.createElement('div'),
            destination = document.querySelector('.posts');
        
        fragment.innerHTML = data.html;
    
        var div = fragment.children[0];
    
        div.removeAttribute('data-id');    
        
        destination.insertBefore(div, destination.children[0]);
        
        mini_blog.createComponent(div);
        mini_blog.editor.setCurrent(div);
        mini_blog.editor.mods.edit.trigger('edit', div);
        
        div.component.data = data.data;
    };
    
    return new Panel(document.getElementById('mini_panel'));
})();