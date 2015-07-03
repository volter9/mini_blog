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
    dom: {},
    utils: {}
};

/**
 * Helpers
 */

/**
 * Convert array-like object to array
 * 
 * @param {Object} arrayLikeObject
 * @return {Array}
 */
mini_blog.toArray = function (arrayLikeObject) {
    return Array.prototype.slice.call(arrayLikeObject);
};

mini_blog.ajax = (function () {
    /**
     * AJAX constructor
     * 
     * @param {String} url
     * @param {String} method
     * @param {Object} data
     */
    function Ajax (url, method, data) {
        this.url = url;
        this.method = method || 'GET';
        this.data = data;
    }
    
    /**
     * Send AJAX request
     */
    Ajax.prototype.send = function () {
        var request = new XMLHttpRequest;
        
        var query = mini_blog.ajax.query(this.data),
            method = this.method.toUpperCase(),
            url = this.url;
        
        var self = this;
    
        if (method === 'GET') {
            url += (url.indexOf('?') === -1 ? '?' : '&') + query;
        }
    
        request.open(method, url);
        request.onreadystatechange = function () {
            var r = this.readyState,
                s = this.status;
            
            if (r === 4 && s === 200 && self.successHandler) {
                self.successHandler(this);
            }
        };
        
        request.onerror = this.errorHandler || function () {};
        
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        request.send(query);
    };
    
    /**
     * Set success handler
     * 
     * @param {Function} handler
     */
    Ajax.prototype.success = function (handler) {
        this.successHandler = handler;
        
        return this;
    };
    
    /**
     * Set error handler
     * 
     * @param {Function} handler
     */
    Ajax.prototype.error = function (handler) {
        this.errorHandler = handler;
        
        return this;
    };
    
    return Ajax;
})();

/**
 * AJAX post shortcut
 * 
 * @param {String} url
 * @param {Object} data
 * @param {Function} callback
 */
mini_blog.ajax.post = function (url, data) { 
    url = [mini_blog.settings.baseurl, url].join('/');
    
    return new mini_blog.ajax(('/' + url).replace(/\/+/, '/'), 'POST', data);
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

/**
 * Make argument node HTML5 editable
 * 
 * @param {Node} node
 */
mini_blog.dom.makeEditable = function (node) {
    node.setAttribute('contenteditable', 'true');
};

/**
 * Unmake argument node HTML5 editable
 * 
 * @param {Node} node
 */
mini_blog.dom.unmakeEditable = function (node) {
    node.removeAttribute('contenteditable');
};

/**
 * Get difference between two objects
 * 
 * @param {Object} a
 * @param {Object} b
 * @return {Object}
 */
mini_blog.utils.diff = function (a, b) {
    for (var key in b) {
        if (typeof a[key] === 'undefined' || b[key] === a[key]) {
            delete a[key];
        }
    }
    
    return a;
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
            constructor: constructor
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
        this.nodes = mini_blog.toArray(
            node.querySelectorAll('[data-name]')
        );
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
    this.nodes.forEach(mini_blog.dom.makeEditable);
};

Settings.prototype.disable = function () {
    this.nodes.forEach(mini_blog.dom.unmakeEditable);
};

Settings.prototype.save = function (callback) {
    var url = ['admin', this.name, this.group].join('/'),
        data = this.collectData();
    
    mini_blog.ajax.post(url, data)
        .success(callback)
        .send();
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
    this.nodes.forEach(mini_blog.dom.makeEditable);
};

Posts.prototype.disable = function () {
    this.nodes.forEach(mini_blog.dom.unmakeEditable);
};

/**
 * Save a post
 * 
 * @param {Function} callback
 */
Posts.prototype.save = function (callback) {
    var exists = Boolean(this.id);
    
    var url = ['admin', this.name, 'add'],
        data = this.collectData();
    
    if (this.id) {
        url.pop();
        url.push('edit');
        url.push(this.id);
    }
    
    mini_blog.ajax.post(url.join('/'), data)
        .success(callback)
        .send();
};

/**
 * Registering components
 */

mini_blog.components.register('settings', Settings);
mini_blog.components.register('post', Posts);