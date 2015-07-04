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
    node.addEventListener("paste", function(e) {
        e.preventDefault();

        var text = e.clipboardData.getData("text/plain");

        document.execCommand("insertHTML", false, text);
    });
    
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
        this.mods = {};
        this.container = document.getElementById('mini_editor');
       
        this.current = null;
        this.active = false;
    }
    
    /**
     * Add a mod to the editor
     * 
     * @param {mini_blog.editor.mod} mod
     */
    Editor.prototype.addMod = function (name, mod) {
        this.mods[name] = mod;
    };
    
    /**
     * Disable all mods
     */
    Editor.prototype.disableMods = function () {
        mini_blog.each(this.mods, function (mod) { 
            mod.disable();
        });
    };
    
    /**
     * Enable given mods
     */
    Editor.prototype.enableMods = function (names) {
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
    Editor.prototype.setCurrent = function (node) {
        if (this.active || !node.component) {
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
     * @param {Function} callback
     */
    Mod.prototype.addAction = function (name, callback) {
        var button = document.createElement('button'),
            self = this;
        
        button.innerText = name;
        button.setAttribute('data-role', name);
        button.className = 'button';
        
        button.addEventListener('click', function () {
            self.trigger(this.getAttribute('data-role'), self.editor.current);
        });
        
        mini_blog.editor.container.appendChild(button);
        
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
    
    Component.prototype.save = function () {};
    
    /**
     * Collect data from component nodes
     * 
     * @return {Object}
     */
    Component.prototype.collectData = function () {
        var data = {};
    
        mini_blog.each(this.nodes, function (node) {
            data[node.getAttribute('data-name')] = node.textContent || node.innerText;
        });
        
        return data;
    };
    
    return Component;
})();

/**
 * Initialization
 */
mini_blog.init = function () {
    var baseurl = document.body.getAttribute('data-baseurl'),
        components = document.querySelectorAll('[data-component]');
    
    mini_blog.settings.baseurl = baseurl;
    
    for (var i = 0, l = components.length; i < l; i ++) {
        var node = components[i],
            attributes = mini_blog.dom.data_attributes(node),
            name = attributes['data-component'];
        
        var component = mini_blog.components.create(name, attributes, node);
        
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
 */
(function () {
    /**
     * Mods
     * 
     * Save and edit mods
     */
    var EditMod = function (editor) {
        mini_blog.mod.call(this, editor);
    };
    
    EditMod.prototype = Object.create(mini_blog.mod.prototype);
    
    EditMod.prototype.init = function () {
        var self = this;
        
        this.name = 'edit';
        
        this.addAction('edit', function (node) {
            self.editor.active = true;
            self.editor.disableMods();
            self.editor.enableMods(['save']);
            
            node.component.enable();
        });
    };
    
    var SaveMod = function (editor) {
        mini_blog.mod.call(this, editor);
    };
    
    SaveMod.prototype = Object.create(mini_blog.mod.prototype);
    
    SaveMod.prototype.init = function () {
        var self = this;
        
        var callback = function (node) {
            self.editor.active = false;
            self.editor.disableMods();
            self.editor.enableMods(['edit']);
            
            node.component.disable();
        };
        
        this.name = 'save';
        
        this.addAction('save', function (node) {
            callback(node);
            
            node.component.save();
        });
        
        this.addAction('cancel', callback);
    };
    
    mini_blog.editor.addMod('edit', new EditMod(mini_blog.editor));
    mini_blog.editor.addMod('save', new SaveMod(mini_blog.editor));
    
    mini_blog.editor.disableMods();
    mini_blog.editor.enableMods(['edit']);
    
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
    
    /**
     * Save settings
     * 
     * @param {Function} callback
     */
    Settings.prototype.save = function (callback) {
        var url = ['admin', this.name, this.group],
            data = this.collectData();
        
        mini_blog.ajax.post(url.join('/'), data)
            .success(callback)
            .send();
    };
    
    /**
     * @param {Object} attributes
     * @param {Node} node
     */
    var Post = function (attributes, node) {
        this.name = 'posts';
        this.id = node.getAttribute('data-id');
        this.data = {};
        
        mini_blog.component.call(this, attributes, node);
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
            
            mini_blog.ajax.post(['admin', this.name, 'get', this.id].join('/'))
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
            data = this.collectData();
        
        if (this.id) {
            url.splice(2, 1, 'edit');
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
    mini_blog.components.register('post', Post);
})();