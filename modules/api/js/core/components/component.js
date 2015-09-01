var utils   = require('../../helpers/utils'),
    extend  = require('../../helpers/extend'),
    overlay = require('../overlay');

/**
 * Component
 * 
 * Base (skeleton) constructor for component objects
 * 
 * @param {Node} node
 */
function Component (node) {
    this.node = node;
    
    this.initialize();
}

Component.prototype = {
    initialize: function () {},
    
    /**
     * Enable component for modification
     */
    enable: function () {
        overlay.show();
    
        this.view.activate();
    },

    /**
     * Disable component for modification
     */
    disable: function () {
        overlay.hide();
    
        this.view.deactivate();
    },

    /**
     * Insert editor
     * 
     * @param {Editor} editor
     */
    insertEditor: function (editor) {
        this.editor = editor;
    
        this.node.appendChild(editor.node);
    },

    /**
     * Save and cancel component actions 
     */
    save:   function () {},
    cancel: function () {}
};

Component.extend = extend(Component);

module.exports = Component;