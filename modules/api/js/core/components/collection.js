var editor = require('../editor'),
    dom    = require('../../helpers/dom');

/**
 * Components
 * 
 * This object is a holder for application components and its children,
 * within mini_blog
 */
var Components = {
    components: {},
    
    /**
     * Register component
     * 
     * @param {String} name
     * @param {Function} constructor
     */
    register: function (name, constructor) {
        this.components[name] = {
            constructor: constructor
        };
    },

    /**
     * Create an instance of component
     * 
     * @param {String} name
     * @param {Node} node
     * @return {mini_blog.component}
     */
    create: function (name, node) {
        if (!this.components[name]) {
            return false;
        }
    
        return new this.components[name].constructor(node);
    },

    /**
     * Create a component
     * 
     * @param {Node} node
     */
    createComponent: function (node) {
        if (node.component || node.dataset.ignore) {
            return;
        }
    
        var name       = node.dataset.component,
            component  = Components.create(name, node);
    
        if (!component) {
            return console.warn('Component "' + name + '" does not exists!');
        }
    
        var view = new editor(null, {
            node:      node,
            component: component
        });
    
        component.insertEditor(view);
    
        node.component = component;
        node.editor    = view;
        node.classList.add('m-anchor');
    }
};

module.exports = Components;