/**
 * @param {Object} attributes
 * @param {Node} node
 */
var Post = function (attributes, node) {
    this.currentMods = ['remove'];
    this.name = 'posts';
    this.data = {};
    this.id = node.getAttribute('data-id');
    
    this.createHiddenElements(node);
    
    mini_blog.component.call(this, attributes, node);
    
    if (this.nodes.text) {
        this.mods = ['wysiwig'];
    }
};

Post.prototype = Object.create(mini_blog.component.prototype);

Post.prototype.createHiddenElements = function (node) {
    var self = this;
    var url = document.createElement('p');
    
    url.className = 'hidden url';
    url.innerHTML = 'Ссылка статьи: <span data-name="url"></span>';
    
    node.insertBefore(url, node.querySelector('[data-name=description]'));
    
    var category = document.createElement('select');
    
    category.className = 'hidden category';
    category.setAttribute('data-name', 'category_id');
    
    node.querySelector('.info li:nth-child(2)').appendChild(category);
    
    var callback = function (xhr, data) {
        if (!data.result) {
            return;
        }
        
        data.result.forEach(function (item) {
            var option = document.createElement('option');
            
            option.value = item.value;
            option.innerText = item.title;
            
            category.appendChild(option);
        });
    };
    
    mini_blog.ajax.get('admin/provider/categories')
                  .success(callback)
                  .send();
};

Post.prototype.showHiddenElements = function (node) {
    var elements = [
        this.node.querySelector('.url'), 
        this.node.querySelector('.category'),
    ];
    
    this.node.querySelector('.fa-tag ~ a').classList.add('hidden');
    this.node.querySelector('.category').value = this.data.category_id;
    
    elements[1].removeAttribute('contenteditable');
    
    elements.forEach(function (node) {
        node.classList.remove('hidden');
    });
};

Post.prototype.hideHiddenElements = function (node) {
    var elements = [
        this.node.querySelector('.url'), 
        this.node.querySelector('.category'),
    ];
    
    elements.forEach(function (node) {
        node.classList.add('hidden');
    });
};

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
        
        console.log(self.data);
        
        mini_blog.each(self.nodes, function (node, key) {
            if (self.data[key]) {
                node.innerHTML = self.data[key];
            }
        });
    };
    
    mini_blog.ajax.post(['admin', this.name, 'get', this.id])
                  .success(callback)
                  .send();
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

Post.prototype.disable = function () {
    mini_blog.component.prototype.disable.call(this);
    
    this.hideHiddenElements();
};

/**
 * Save a post
 */
Post.prototype.save = function () {
    var url = ['admin', this.name, 'add'],
        data, self = this;
    
    data = mini_blog.utils.merge(this.data, this.collectData());
    data = mini_blog.utils.diff(data, this.data);
    
    if (this.id) {
        url.splice(2, 1, 'edit');
        url.push(this.id);
    }
    
    var callback = function (_, data) {
        if (data.id) {
            self.id = data.id;
        }
        
        mini_blog.toArray(self.node.querySelectorAll('pre'))
                 .forEach(hljs.highlightBlock);
    };
    
    mini_blog.ajax.post(url, data)
                  .success(callback)
                  .send();
};

mini_blog.components.register('post', Post);