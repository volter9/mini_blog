var utils   = require('../../helpers/utils'),
    extend  = require('../../mvc/extend'),
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

Component.prototype.initialize = function () {};

/**
 * Enable component for modification
 */
Component.prototype.enable = function () {
    overlay.show();
    
    this.view.activate();
};

/**
 * Disable component for modification
 */
Component.prototype.disable = function () {
    overlay.hide();
    
    this.view.deactivate();
};

/**
 * Insert editor
 * 
 * @param {Editor} editor
 */
Component.prototype.insertEditor = function (editor) {
    this.editor = editor;
    
    this.node.appendChild(editor.node);
};

/**
 * Save and cancel component actions 
 */
Component.prototype.save = function () {};
Component.prototype.cancel = function () {};

Component.extend = extend(Component);

module.exports = Component;