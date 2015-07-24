var panel = require('./panel'),
    dom   = require('../helpers/dom');

/**
 * Components
 * 
 * This object is a holder for application components and its children,
 * within mini_blog
 */
var Components = {
    components: {}
};

/**
 * Register component
 * 
 * @param {String} name
 * @param {Function} constructor
 */
Components.register = function (name, constructor) {
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
Components.create = function (name, attributes, node) {
    if (!this.components[name]) {
        return false;
    }
    
    return new this.components[name].constructor(attributes, node);
};

/**
 * Create a component
 * 
 * @param {Node} node
 */
Components.createComponent = function (node) {
    if (node.component || node.getAttribute('data-ignore')) {
        return;
    }
    
    var attributes = dom.dataAttributes(node),
        name       = attributes['data-component'],
        component  = Components.create(name, attributes, node);
    
    if (!component) {
        return console.warn('Component "' + name + '" does not exists!');
    }
    
    node.component = component;
    node.addEventListener('mouseenter', function () {
        panel.setCurrent(this);
    });
};

module.exports = Components;