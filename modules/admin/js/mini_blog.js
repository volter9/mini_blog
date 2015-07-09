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
    node.setAttribute('contenteditable', 'true');
    
    if (node.editable) {
        return;
    }
    
    node.addEventListener('paste', function(e) {
        e.preventDefault();

        var text = e.clipboardData.getData('text/plain')
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
    
    node.editable = true;
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
     * Editor constructor
     */
    function Editor () {
        this.mods = {};
        this.current = null;
        this.active = false;
       
        this.setupContainer();
    }
    
    /**
     * Setup editor's container for buttons
     */
    Editor.prototype.setupContainer = function () {
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
        
        var mods = ['edit'].concat(node.component.currentMods || []);
        
        this.current = node;
        
        this.disableMods();
        this.enableMods(mods);
        
        this.move(node);
    };
    
    Editor.prototype.clearCurrent = function () {
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
     * 
     * @param {Function} callback
     */
    Component.prototype.save = function (callback) {};
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
 */
mini_blog.init = function () {
    var baseurl = document.body.getAttribute('data-baseurl');
    
    mini_blog.settings.baseurl = baseurl;
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
    var attributes = mini_blog.dom.data_attributes(node),
        name = attributes['data-component'];
    
    var component = mini_blog.components.create(name, attributes, node);
    
    if (!component) {
        return console.warn('Component "' + name + '" does not exists!');
    }
    
    if (node.getAttribute('data-ignore') === null) {
        node.component = component;
        node.addEventListener('mouseenter', function () {
            mini_blog.editor.setCurrent(this);
        });
    }
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
        this.name = 'edit';
        
        mini_blog.mod.call(this, editor);
    };
    
    EditMod.prototype = Object.create(mini_blog.mod.prototype);
    
    /**
     * Initiate edit mod
     */
    EditMod.prototype.init = function () {
        var self = this;
        
        this.addAction('edit', function (node) {
            self.editor.active = true;
            self.editor.disableMods();
            self.editor.enableMods(['save'].concat(node.component.mods || []));
            
            node.component.enable();
        });
    };
    
    var RemoveMod = function (editor) {
        this.name = 'remove';
        
        mini_blog.mod.call(this, editor);
    };
    
    RemoveMod.prototype = Object.create(mini_blog.mod.prototype);
    
    /**
     * Initiate edit mod
     */
    RemoveMod.prototype.init = function () {
        var self = this;
        
        this.addAction('remove', function (node) {
            node.component.remove();
            
            self.editor.clearCurrent();
        });
    };
    
    /**
     * SaveMod
     * 
     * Sends signal to component to send the data to the server
     * Also has a cancel action to cancel 
     * 
     * @param {mini_blog.editor} editor
     */
    var SaveMod = function (editor) {
        this.name = 'save';
        
        mini_blog.mod.call(this, editor);
    };
    
    SaveMod.prototype = Object.create(mini_blog.mod.prototype);
    
    /**
     * Initiate actions:
     * 
     * - Save action
     * - Cancel action
     */
    SaveMod.prototype.init = function () {
        var self = this;
        
        var callback = function (node) {
            self.editor.active = false;
            self.editor.disableMods();
            self.editor.enableMods(['edit']);
            
            node.component.disable();
        };
        
        this.addAction('save', function (node) {
            node.component.save();
            
            callback(node);
        });
        
        this.addAction('cancel', function (node) {
            node.component.cancel();
            
            callback(node);
            
            if (self.html) {
                node.innerHTML = self.html;
                node.component.setNodes(node);
            }
        });
    };
    
    /**
     * Enable save mod and cache the HTML
     */
    SaveMod.prototype.enable = function () {
        mini_blog.mod.prototype.enable.call(this);
        
        this.html = this.editor.current.innerHTML;
    };
    
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
     * - Clear formating (paragraph)
     * - Code
     */
    WysiwigMod.prototype.init = function () {
        var self = this;
        
        this.name = 'wysiwig';
        
        this.addAction('bold', function () {
            document.execCommand('bold');
        });
        
        this.addAction('italic', function () {
            document.execCommand('italic');
        });
        
        this.addAction('quote', function () {
            document.execCommand('formatBlock', null, 'blockquote');
        });
        
        this.addAction('header', function () {
            document.execCommand('formatBlock', null, 'h1');
        });
        
        this.addAction('paragraph', function () {
            document.execCommand('formatBlock', null, 'p');
            
            var selection = document.getSelection(),
                p = selection.anchorNode.parentNode;
            
            if (p.nodeName !== 'P') {
                p = p.parentNode;
            }
            
            p.innerHTML = p.innerText || p.textContent;
        });
        
        this.addAction('code', function () {
            document.execCommand('formatBlock', null, 'pre');
        });
    };
    
    
    /**
     * Register all mods and enable edit mod **only**
     */
    mini_blog.editor.addMod('edit', new EditMod(mini_blog.editor));
    mini_blog.editor.addMod('save', new SaveMod(mini_blog.editor));
    mini_blog.editor.addMod('wysiwig', new WysiwigMod(mini_blog.editor));
    mini_blog.editor.addMod('remove', new RemoveMod(mini_blog.editor));
    
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
    var Category = function (attributes, node) {
        this.name = 'categories';
        this.id = node.getAttribute('data-id');
        
        mini_blog.component.call(this, attributes, node);
    };
    
    Category.prototype = Object.create(mini_blog.component.prototype);
    
    /**
     * Save settings
     * 
     * @param {Function} callback
     */
    Category.prototype.save = function (callback) {
        var url = ['admin', this.name, 'edit', this.id],
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
            
            mini_blog.ajax.post(['admin', this.name, 'get', this.id].join('/'))
                          .success(callback)
                          .send();
        }
    };
    
    Post.prototype.cancel = function () {
        if (this.id) {
            return;
        }
        
        this.node.parentNode.removeChild(this.node);
        
        mini_blog.editor.clearCurrent();
    };
    
    Post.prototype.remove = function () {
        var self = this;
        
        if (this.id) {
            var callback = function () {
                self.id = null;
                self.cancel();
            };
            
            mini_blog.ajax.post(['admin', this.name, 'remove', this.id].join('/'))
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
        
        mini_blog.ajax.post(url.join('/'), data)
                      .success(func)
                      .send();
    };
    
    /**
     * @param {Object} attributes
     * @param {Node} node
     */
    var Add = function (attributes, node) {
        this.item = node.getAttribute('data-item');
        
        mini_blog.component.call(this, attributes, node);
        
        this.destination = document.querySelector(node.getAttribute('data-destination'));
        this.setupEvents();
    };
    
    Add.prototype = Object.create(mini_blog.component.prototype);
    
    /**
     * Setup events for add button
     */
    Add.prototype.setupEvents = function () {
        var self = this;
        
        this.node.addEventListener('click', function () {
            if (!mini_blog.editor.active) {
                var node = self.createNode(self.item, self.destination);
            }
        });
    };
    
    /**
     * Create a node from template requested via AJAX
     * 
     * @param {String} item
     * @param {Node} destination
     */
    Add.prototype.createNode = function (item, destination) {
        var url = ['admin', 'template', item].join('/');
        
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
    Add.prototype.addNode = function (xhr, data) {
        var fragment = document.createElement('div'),
            destination = this.destination;
    
        fragment.innerHTML = data.html;
    
        var div = fragment.children[0];
    
        div.removeAttribute('data-id');    
        
        destination.insertBefore(div, destination.children[1]);
        
        mini_blog.createComponent(div);
        mini_blog.editor.setCurrent(div);
        mini_blog.editor.mods.edit.trigger('edit', div);
        
        div.component.data = data.data;
    };
    
    /**
     * Registering components
     */
    
    mini_blog.components.register('settings', Settings);
    mini_blog.components.register('post', Post);
    mini_blog.components.register('category', Category);
    mini_blog.components.register('add', Add);
})();