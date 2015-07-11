/**
 * @param {Object} attributes
 * @param {Node} node
 */
var Post = function (attributes, node) {
    this.name = 'posts';
    this.id = node.getAttribute('data-id');
    this.data = {};
    this.currentMods = ['remove'];
    
    mini_blog.component.call(this, attributes, node);
    
    if (this.nodes.text) {
        this.mods = ['wysiwig'];
    }
};

Post.prototype = Object.create(mini_blog.component.prototype);

/**
 * Enable post with custom logic
 */
Post.prototype.enable = function () {
    mini_blog.component.prototype.enable.call(this);
    
    if (this.id) {
        var self = this;
        
        var callback = function (xhr, data) {
            self.data = data.item;
            
            mini_blog.each(self.nodes, function (node, key) {
                node.innerHTML = self.data[key];
            });
        };
        
        mini_blog.ajax.post(['admin', this.name, 'get', this.id])
                      .success(callback)
                      .send();
    }
};

/**
 * Cancel editing
 * 
 * 
 */
Post.prototype.cancel = function () {
    if (this.id) {
        return;
    }
    
    this.node.parentNode.removeChild(this.node);
    
    mini_blog.editor.clearCurrent();
};

/**
 * Remove a post
 */
Post.prototype.remove = function () {
    var self = this;
    
    if (this.id) {
        var callback = function () {
            self.id = null;
            self.cancel();
        };
        
        mini_blog.ajax.post(['admin', this.name, 'remove', this.id])
                      .success(callback)
                      .send();
    }
};

/**
 * Save a post
 * 
 * @param {Function} callback
 */
Post.prototype.save = function (callback) {
    var url = ['admin', this.name, 'add'],
        data = mini_blog.utils.merge(this.data, this.collectData()),
        self = this;
    
    if (this.id) {
        url.splice(2, 1, 'edit');
        url.push(this.id);
    }
    
    var func = function (_, data) {
        if (data.id) {
            self.id = data.id;
        }
        
        callback();
    };
    
    mini_blog.ajax.post(url, data)
                  .success(func)
                  .send();
};

mini_blog.components.register('post', Post);