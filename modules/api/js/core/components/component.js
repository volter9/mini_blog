var utils = require('../../helpers/utils');

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
    this.view.activate();
};

/**
 * Disable component for modification
 */
Component.prototype.disable = function () {
    this.view.deactivate();
};

/**
 * Save and cancel component actions 
 */
Component.prototype.save = function () {};
Component.prototype.cancel = function () {};

module.exports = Component;