/**
 * @param {Object} attributes
 * @param {Node} node
 */
var Post = function (attributes, node) {
    this.name = 'posts';
    this.data = {};
    this.id = node.getAttribute('data-id');
    this.mods = ['wysiwig'];
    
    mini_blog.component.call(this, attributes, node);
};

Post.prototype = Object.create(mini_blog.component.prototype);

/**
 * Enable post with custom logic
 */
Post.prototype.enable = function () {
    mini_blog.component.prototype.enable.call(this);
    
    if (!this.id) {
        return;
    }
    
    var self = this;
    
    var callback = function (xhr, data) {
        if (!data.item) {
            return;
        }
        
        self.data = data.item;
        
        mini_blog.each(self.nodes, function (node, key) {
            if (self.data[key]) {
                node.innerHTML = self.data[key];
            }
        });
    };
    
    mini_blog.ajax.get(['admin', this.name, 'get', this.id])
                  .success(callback)
                  .send();
};

Post.prototype.disable = function () {
    mini_blog.component.prototype.disable.call(this);
    
    mini_blog.toArray(this.node.querySelectorAll('pre'))
             .forEach(hljs.highlightBlock);
};

/**
 * Cancel editing
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
    if (!this.id) {
        return;
    }
    
    var self = this;
    
    var callback = function () {
        self.id = null;
        self.cancel();
    };
    
    mini_blog.ajax.post(['admin', this.name, 'remove', this.id])
                  .success(callback)
                  .send();
};

/**
 * Save a post
 */
Post.prototype.save = function () {
    var url = ['admin', this.name, 'add'],
        data, self = this;
    
    data = mini_blog.merge(this.data, this.collectData());
    data = mini_blog.diff(data, this.data);
    
    if (this.id) {
        url.splice(2, 1, 'edit');
        url.push(this.id);
    }
    
    var callback = function (_, data) {
        if (data.id) {
            self.id = data.id;
        }
    };
    
    mini_blog.ajax.post(url, data)
                  .success(callback)
                  .send();
};

mini_blog.components.register('post', Post);