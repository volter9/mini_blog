/**
 * mini_blog.js
 * 
 * JS library for inline edit and other stuff for mini_blog
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
    url = url.replace(/\/+/, '/');
    
    mini_blog.ajax(url, 'POST', data, callback);
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
        result += v + '=' + encodeURIComponent(object[v]) + '&';
    });
    
    return result.substr(0, -1);
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
    
    return new Editor;
})();

/**
 * 
 * 
 * 
 */
mini_blog.editor.mod = function () {
    
};

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
    
    return Component;
})();

/**
 * Initialization
 */
mini_blog.init = function () {
    if (mini_blog.settings.init) {
        return;
    }
    
    var baseurl = document.body.getAttribute('data-baseurl') || '',
        components = document.querySelectorAll('[data-component]');
    
    mini_blog.settings.baseurl = baseurl;
    
    for (var i = 0, l = components.length; i < l; i ++) {
        var component = components[i],
            attributes = mini_blog.dom.data_attributes(component),
            name = attributes['data-component'];
        
        var instance = mini_blog.components.create(name, [attributes, component]);
        
        if (!instance) {
            console.warn('Component "' + name + '" does not exists!');
        }
    }
    
    mini_blog.settings.init = true;
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
    
    mini_blog.component.call(this, attributes, node);
};

Settings.prototype = Object.create(mini_blog.component.prototype);

/**
 * Get group for current component
 * 
 * @param {Node} element
 * @return {String}
 */
Settings.prototype.getGroup = function (element) {
    var group = this.node.getAttribute('data-group');
    
    return group || element.getAttribute('data-group');
};

Settings.prototype.activate = function () {
    console.log('Hello, world!');
};

/**
 * @param {Object} attributes
 * @param {Node} node
 */
var Posts = function (attributes, node) {
    this.name = 'posts';
    
    mini_blog.component.call(this, attributes, node);
};

Posts.prototype = Object.create(mini_blog.component.prototype);

Posts.prototype.activate = function () {
    console.log('Hello, posts!');
};

/**
 * Registering components
 */

mini_blog.components.register('settings', Settings);
mini_blog.components.register('post', Posts);