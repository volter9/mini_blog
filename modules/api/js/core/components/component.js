var utils = require('../../helpers/utils'),
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
    this.node.style.position = 'relative';
    this.node.style.zIndex = 9000;
    overlay.show();
    
    this.view.activate();
};

/**
 * Disable component for modification
 */
Component.prototype.disable = function () {
    this.node.style.position = '';
    this.node.style.zIndex = '';
    overlay.hide();
    
    this.view.deactivate();
};

Component.prototype.insertEditor = function (editor) {
    this.editor = editor;
    
    this.node.appendChild(editor.node);
};

/**
 * Save and cancel component actions 
 */
Component.prototype.save = function () {};
Component.prototype.cancel = function () {};

module.exports = Component;