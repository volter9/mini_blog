/**
 * mini_blog.js
 * 
 * JS library for inline edit and other stuff for CMS mini_blog
 * 
 * @author volter9
 * @package mini_blog
 */

var mini_blog = {
    settings: {},
    dom: {}
};

/**
 * Helpers
 */

/**
 * AJAX helper function
 * 
 * @param {String} url
 * @param {String} method
 * @param {Object} data
 * @param {Function} callback
 */
mini_blog.ajax = function (url, method, data, callback) {
    var request = new XMLHttpRequest,
        query = mini_blog.ajax.query(data);
    
    method = method || 'GET';
    method = method.toUpperCase();
    
    if (method === 'GET') {
        url += (url.indexOf('?') === -1 ? '?' : '&') + query;
    }
    
    request.open(method, url);
    request.onreadystatechange = function () {
        callback(this, request.readyState, request.status);
    };
    
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    request.send(query);
};

/**
 * AJAX post shortcut
 * 
 * @param {String} url
 * @param {Object} data
 * @param {Function} callback
 */
mini_blog.ajax.post = function (url, data, callback) { 
    url = '/' + mini_blog.settings.baseurl + '/' + url;
    
    mini_blog.ajax(url.replace(/\/+/, '/'), 'POST', data, callback);
};

/**
 * Encode object into query string
 * 
 * @param {Object} object
 * @return {String}
 */
mini_blog.ajax.query = function (object) {
    var result = '',
        keys = Object.keys(object);
    
    keys.forEach(function (v, k) {
        result += encodeURIComponent(v) + '=' + encodeURIComponent(object[v]) + '&';
    });
    
    return result.substr(0, result.length - 1);
};

/**
 * Get all attributes from DOM element
 * 
 * @link http://stackoverflow.com/questions/2048720/
 *       get-all-attributes-from-a-html-element-with-javascript-jquery
 * @param {Node} element
 * @return {Object}
 */
mini_blog.dom.attributes = function (element) {
    var result = {},
        attributes = element.attributes;
    
    for (var i = 0, l = attributes.length; i < l; i ++) {
        var attribute = attributes[i];
        
        result[attribute.nodeName] = attribute.nodeValue;
    }
    
    return result;
};

/**
 * Get all data attributes from DOM element
 * 
 * @param {Node} element
 * @return {Object}
 */
mini_blog.dom.data_attributes = function (element) {
    var attributes = mini_blog.dom.attributes(element);
    
    Object.keys(attributes).forEach(function (key) {
        if (key.indexOf('data-') !== 0) {
            delete attributes[key];
        }
    });
    
    return attributes;
};

mini_blog.dom.makeEditable = function (node) {
    node.setAttribute('contenteditable', 'true');
};

mini_blog.dom.unmakeEditable = function (node) {
    node.removeAttribute('contenteditable');
};

/**
 * Core
 */

/**
 * Editor
 * 
 * A set of buttons which will be visible near the components
 * on hover
 */
mini_blog.editor = (function () {
    function Editor () {
        this.mods = [];
        this.current = null;
        this.container = document.getElementById('mini_editor');
        this.active = false;
        
        var edit = this.container.querySelector('[data-role=edit]'),
            self = this;
        
        edit.addEventListener('click', function () {
            if (!self.current) {
                return;
            }
            
            var component = self.current.component;
            
            if (!self.active) {
                component.enable();
                
                self.active = true;
                this.innerHTML = 'Save';
            }
            else {
                component.disable();
                component.save(function () {
                    self.active = false;
                    edit.innerHTML = 'Edit'; 
                });
            }
        });
    }
    
    /**
     * Add a mod to the editor
     * 
     * @param {mini_blog.editor.mod} mod
     */
    Editor.prototype.addMod = function (mod) {
        this.mods.push(mod);
    };
    
    /**
     * Clear all mods
     */
    Editor.prototype.clearMods = function () {
        this.mods = [];
    };
    
    /**
     * Set current editing component
     * 
     * @param {Node} node
     */
    Editor.prototype.setCurrent = function (node) {
        if (this.active) {
            return;
        }
        
        this.current = node;
        this.move(node);
    };
    
    /**
     * Move container with editor buttons
     * 
     * @param {Node} node
     */
    Editor.prototype.move = function (node) {
        this.container.className = 'visible';
        
        var x = node.offsetLeft - this.container.offsetWidth - 10,
            y = node.offsetTop;
        
        this.container.style.left = x + 'px';
        this.container.style.top = y + 'px';
    };
    
    return new Editor;
})();

/**
 * Editor modification
 * 
 * 
 */
mini_blog.editor.mod = (function () {
    function Mod () {
        
    }
    
    return Mod;
})();

/**
 * Components
 * 
 * This object is a holder for application components and its children,
 * within mini_blog
 */
mini_blog.components = (function () {
    function Components () {
        this.components = {};
    }
    
    /**
     * Register component
     * 
     * @param {String} name
     * @param {Function} constructor
     */
    Components.prototype.register = function (name, constructor) {
        this.components[name] = {
            constructor: constructor,
            children: []
        };
    };
    
    /**
     * Create an instance of component
     * 
     * @param {String} name
     * @param {Array} args
     * @return {mini_blog.component}
     */
    Components.prototype.create = function (name, args) {
        if (!this.components[name]) {
            return false;
        }
        
        return this.construct(this.components[name].constructor, args || []);
    };
    
    /**
     * @param {String} name
     * @param {Component} child
     */
    Components.prototype.addChild = function (name, child) {
        if (!this.components[name]) {
            return false;
        }
        
        this.components[name].children.push(child);
    };
    
    /**
     * @param {String} name
     * @return {Component}
     */
    Components.prototype.getChildren = function (name) {
        if (!this.components[name]) {
            return false;
        }
        
        return this.components[name].children;
    };
    
    /**
     * Construct an object with dynamic array of arguments
     * 
     * @link http://stackoverflow.com/questions/1606797/
     *       use-of-apply-with-new-operator-is-this-possible
     * @param {Function} constructor
     * @param {Array} args
     * @return {Object}
     */
    Components.prototype.construct = function (constructor, args) {
        function F () {
            return constructor.apply(this, args);
        }
        
        F.prototype = constructor.prototype;
        
        return new F();
    }
    
    return new Components();
})();

/**
 * Component
 * 
 * Base (skeleton) constructor for component objects
 */
mini_blog.component = (function () {
    /**
     * @param {Object} attributes
     * @param {Node} node
     */
    function Component (attributes, node) {
        this.attrubutes = attributes;
        this.node = node;
        this.nodes = node.querySelectorAll('[data-name]');
    }
    
    Component.prototype.enable = function () {};
    Component.prototype.disable = function () {};
    Component.prototype.save = function () {};
    
    /**
     * Collect data from component nodes
     * 
     * @return {Object}
     */
    Component.prototype.collectData = function () {
        var data = {};
    
        for (var i = 0, l = this.nodes.length; i < l; i ++) {
            var node = this.nodes[i],
                value = node.innerText || node.textContent;
        
            data[node.getAttribute('data-name')] = value.trim();
        }
        
        return data;
    };
    
    return Component;
})();

/**
 * Initialization
 */
mini_blog.init = function () {
    var baseurl = document.body.getAttribute('data-baseurl') || '',
        components = document.querySelectorAll('[data-component]');
    
    mini_blog.settings.baseurl = baseurl;
    
    for (var i = 0, l = components.length; i < l; i ++) {
        var node = components[i],
            attributes = mini_blog.dom.data_attributes(node),
            name = attributes['data-component'];
        
        var component = mini_blog.components.create(name, [attributes, node]);
        
        if (!component) {
            console.warn('Component "' + name + '" does not exists!');
            
            continue;
        }
        
        node.component = component;
        node.addEventListener('mouseenter', function () {
            mini_blog.editor.setCurrent(this);
        });
    }
    
    mini_blog.init = null;
};

/**
 * Core modules support
 * 
 * - Settings
 * - Posts
 * - Categories
 */
 
/**
 * @param {Object} attributes
 * @param {Node} node
 */
var Settings = function (attributes, node) {
    this.name = 'settings';
    this.group = node.getAttribute('data-group');
    
    mini_blog.component.call(this, attributes, node);
};

Settings.prototype = Object.create(mini_blog.component.prototype);

Settings.prototype.enable = function () {
    for (var i = 0, l = this.nodes.length; i < l; i ++) {
        var node = this.nodes[i];
        
        mini_blog.dom.makeEditable(node);
    }
};

Settings.prototype.disable = function () {
    for (var i = 0, l = this.nodes.length; i < l; i ++) {
        var node = this.nodes[i];
        
        mini_blog.dom.unmakeEditable(node);
    }
};

Settings.prototype.save = function (callback) {
    var url = ['admin', this.name, this.group],
        data = this.collectData();
    
    mini_blog.ajax.post('/' + url.join('/'), data, function (x, r, s) {
        if (r === 4 && s === 200) {
            callback();
        }
    });
};

/**
 * @param {Object} attributes
 * @param {Node} node
 */
var Posts = function (attributes, node) {
    this.name = 'posts';
    this.id = node.getAttribute('data-id');
    
    mini_blog.component.call(this, attributes, node);
};

Posts.prototype = Object.create(mini_blog.component.prototype);

Posts.prototype.enable = function () {
    for (var i = 0, l = this.nodes.length; i < l; i ++) {
        var node = this.nodes[i];
        
        mini_blog.dom.makeEditable(node);
    }
};

Posts.prototype.disable = function () {
    for (var i = 0, l = this.nodes.length; i < l; i ++) {
        var node = this.nodes[i];
        
        mini_blog.dom.unmakeEditable(node);
    }
};

Posts.prototype.save = function (callback) {
    var exists = Boolean(this.id);
    
    var url = ['admin', this.name, 'add'],
        data = this.collectData();
    
    if (this.id) {
        url.pop();
        url.push('edit');
        url.push(this.id);
    }
    
    mini_blog.ajax.post('/' + url.join('/'), data, function (x, r, s) {
        if (r === 4 && s === 200) {
            callback();
        }
    });
};

/**
 * Registering components
 */

mini_blog.components.register('settings', Settings);
mini_blog.components.register('post', Posts);