/**
 * mini_blog.js
 * 
 * JS library for inline edit and other stuff for mini_blog
 * 
 * Probably looks like one of those JS frameworks, but it's
 * not. It's more like a set of utilities.
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
 * EventEmitter mixin
 * 
 * @param {Object} proto
 */
mini_blog.events = function (proto) {
    proto._events = {};
    
    /**
     * Bind an event
     * 
     * @param {String} event
     * @param {Function} callback
     */
    proto.on = function (event, callback) {
        if (!this._events[event]) {
            this._events[event] = [];
        }
        
        this._events[event].push(callback);
    };
    
    /**
     * Emit an event
     * 
     * @param {String} event
     * @param {Array} args
     */
    proto.emit = function (event, args) {
        this._events[event].forEach(function (callback) {
            callback.apply(null, args || []);
        });
    };
};

/**
 * Convert array-like object to array
 * 
 * @param {Object} arrayLikeObject
 * @return {Array}
 */
mini_blog.toArray = function (arrayLikeObject) {
    return Array.prototype.slice.call(arrayLikeObject);
};

/**
 * Simple $.each, only for objects
 * 
 * @param {Object} object
 * @param {Function} callback
 */
mini_blog.each = function (object, callback) {
    for (var key in object) {
        if (object.hasOwnProperty(key)) {
            callback(object[key], key);
        }
    }
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
        this.data = data || {};
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
                self.successHandler(this, JSON.parse(this.responseText));
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
 * @param {String|Array} url
 * @param {Object} data
 * @param {Function} callback
 */
mini_blog.ajax.post = function (url, data) { 
    return new mini_blog.ajax(mini_blog.ajax.url(url), 'POST', data);
};

/**
 * AJAX get shortcut
 * 
 * @param {String|Array} url
 * @param {Object} data
 * @param {Function} callback
 */
mini_blog.ajax.get = function (url, data) { 
    return new mini_blog.ajax(mini_blog.ajax.url(url), 'GET', data);
};

/**
 * Convert relative url to full url
 * 
 * Empty string is needed to avoid ugly `('/' + url.join('/'))`
 * snippet
 * 
 * @param {String|Array} url
 * @return {String}
 */
mini_blog.ajax.url = function (url) {
    url = Array.isArray(url)
        ? ['', mini_blog.settings.baseurl].concat(url)
        : ['', mini_blog.settings.baseurl, url];
    
    return url.join('/').replace(/\/+/, '/');
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
        result += encodeURIComponent(v) 
               + '=' 
               + encodeURIComponent(object[v]) + '&';
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
mini_blog.dom.dataAttributes = function (element) {
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
    
    if (node.isEditable) {
        return;
    }
    
    node.addEventListener('paste', function(e) {
        e.preventDefault();

        var text = e.clipboardData
                    .getData('text/plain')
                    .replace(/\</g, '&lt;')
                    .replace(/\>/g, '&gt;')
                    .replace(/\n\r?/g, '<br/>\n');

        document.execCommand('insertHTML', false, text);
    });

    node.addEventListener('keyup', function (e) {
        if (e.keyCode === 13) {
            document.execCommand('formatBlock', null, 'p');
        }
    });
    
    // Custom attribute
    node.isEditable = true;
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
    var c = {};
    
    for (var key in b) {
        if (typeof a[key] === 'undefined' || b[key] !== a[key]) {
            c[key] = a[key];
        }
    }
    
    return c;
};

/**
 * Merge two objects
 * 
 * @param {Object} a
 * @param {Object} b
 * @return {Object}
 */
mini_blog.utils.merge = function (a, b) {
    var c = {}, key;
    
    for (key in a) {
        c[key] = a[key];
    }
    
    for (key in b) {
        c[key] = b[key];
    }
    
    return c;
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
    /**
     * Setup editor's container for buttons
     */
    function setupContainer () {
        var container = document.createElement('div');
        
        container.id = 'mini_editor';
        container.className = 'hidden';
        
        document.body.appendChild(container);
        
        this.container = container;
    };
    
    /**
     * Add a mod to the editor
     * 
     * @param {mini_blog.editor.mod} mod
     */
    function addMod (name, mod) {
        this.mods[name] = mod;
    };
    
    /**
     * Disable all mods
     */
    function disableMods () {
        mini_blog.each(this.mods, function (mod) { 
            mod.disable();
        });
    };
    
    /**
     * Enable given mods
     */
    function enableMods (names) {
        mini_blog.each(this.mods, function (mod) { 
            if (names.indexOf(mod.name) !== -1) {
                mod.enable();
            }
        });
    };
    
    /**
     * Set current editing component
     * 
     * @param {Node} node
     */
    function setCurrent (node) {
        if (this.active || !node.component) {
            return;
        }
        
        var mods = ['edit'].concat(node.component.currentMods || []);
        
        this.current = node;
        
        this.disableMods();
        this.enableMods(mods);
        
        this.move(node);
    };
    
    /**
     * Clear current editable target
     */
    function clearCurrent () {
        if (!this.active) {
            return;
        }
        
        this.active = false;
        this.container.className = 'hidden';
    };
    
    /**
     * Move container with editor buttons
     * 
     * @param {Node} node
     */
    function move (node) {
        this.container.className = 'visible';
        
        var x = node.offsetLeft - this.container.offsetWidth - 10,
            y = node.offsetTop;
        
        this.container.style.left = x + 'px';
        this.container.style.top = y + 'px';
    };
    
    var object = {
        mods: {},
        current: null,
        active: false,
        
        setupContainer: setupContainer,
        addMod: addMod,
        disableMods: disableMods,
        enableMods: enableMods,
        setCurrent: setCurrent,
        clearCurrent: clearCurrent,
        move: move
    };
    
    object.setupContainer();
    
    return object;
})();

/**
 * Editor modification
 * 
 * Set of action (i.e. buttons) which can be assigned with different
 */
mini_blog.mod = (function () {
    /**
     * @param {mini_blog.editor}
     */
    function Mod (editor) {
        this.editor = editor;
        this.actions = {};
        
        this.init();
    }
    
    Mod.prototype.init = function () {};
    
    /**
     * Enable mod
     */
    Mod.prototype.enable = function () {
        mini_blog.each(this.actions, function (action) {
            action.button.style.display = 'block';
        });
    };
    
    /**
     * Disable mod
     */
    Mod.prototype.disable = function () {
        mini_blog.each(this.actions, function (action) {
            action.button.style.display = 'none';
        });
    };
    
    /**
     * Add a named action
     * 
     * @param {String} name
     * @param {String} text
     * @param {Function} callback
     */
    Mod.prototype.addAction = function (name, text, callback) {
        var button = document.createElement('button'),
            self = this;
        
        button.innerHTML = !callback ? name : text;
        button.setAttribute('data-role', name);
        button.className = 'button';
        
        button.addEventListener('click', function () {
            self.trigger(this.getAttribute('data-role'), self.editor.current);
        });
        
        this.editor.container.appendChild(button);
        
        callback = callback || text;
        callback.button = button;
        
        this.actions[name] = callback;
    };
    
    /**
     * Trigger the mod action
     * 
     * @param {String} name
     */
    Mod.prototype.trigger = function (name, node) {
        if (!this.actions[name]) {
            return;
        }
        
        this.actions[name](node);
    };
    
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
    Components.prototype.create = function (name, attributes, node) {
        if (!this.components[name]) {
            return false;
        }
        
        return new this.components[name].constructor(attributes, node);
    };
    
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
        this.nodes = {};
        
        this.setNodes(node);
    }
    
    /**
     * Setup nodes
     * 
     * @param {Node} node
     */
    Component.prototype.setNodes = function (node) {
        var nodes = mini_blog.toArray(
            node.querySelectorAll('[data-name]')
        );
        
        var self = this;
        
        Object.keys(nodes).forEach(function (key) {
            var node = nodes[key];
            
            self.nodes[node.getAttribute('data-name')] = node;
        });
    };
    
    /**
     * Enable component for modification
     */
    Component.prototype.enable = function () {
        mini_blog.each(this.nodes, mini_blog.dom.makeEditable);
    };
    
    /**
     * Disable component for modification
     */
    Component.prototype.disable = function () {
        mini_blog.each(this.nodes, mini_blog.dom.unmakeEditable);
    };
    
    /**
     * Save component 
     */
    Component.prototype.save = function () {};
    Component.prototype.cancel = function () {};
    
    /**
     * Collect data from component nodes
     * 
     * @return {Object}
     */
    Component.prototype.collectData = function () {
        var data = {};
    
        mini_blog.each(this.nodes, function (node) {
            data[node.getAttribute('data-name')] = node.innerHTML;
        });
        
        return data;
    };
    
    return Component;
})();

/**
 * Initialization
 * 
 * @param {Array} scripts
 */
mini_blog.init = function (scripts) {
    var baseurl = document.body.getAttribute('data-baseurl'),
        lang    = document.body.getAttribute('data-lang');
    
    mini_blog.settings.baseurl = baseurl;
    mini_blog.settings.lang    = lang;
    mini_blog.init = null;

    mini_blog.toArray(document.querySelectorAll('[data-component]'))
             .forEach(mini_blog.createComponent);
};

/**
 * Create a component
 * 
 * @param {Node} node
 */
mini_blog.createComponent = function (node) {
    if (node.component || node.getAttribute('data-ignore')) {
        return;
    }
    
    var attributes = mini_blog.dom.dataAttributes(node),
        name       = attributes['data-component'],
        component  = mini_blog.components.create(name, attributes, node);
    
    if (!component) {
        return console.warn('Component "' + name + '" does not exists!');
    }
    
    node.component = component;
    node.addEventListener('mouseenter', function () {
        mini_blog.editor.setCurrent(this);
    });
};