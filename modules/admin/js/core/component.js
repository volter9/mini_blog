var utils = require('../helpers/utils');

/**
 * Component
 * 
 * Base (skeleton) constructor for component objects
 * 
 * @param {Node} node
 */
function Component (node) {
    this.node = node;
    this.nodes = {};
    
    this.setNodes(node);
    this.initialize();
}

Component.prototype.initialize = function () {};

/**
 * Setup nodes
 * 
 * @param {Node} node
 */
Component.prototype.setNodes = function (node) {
    var nodes = utils.toArray(
        node.querySelectorAll('[data-name]')
    );
    
    var self = this;
    
    Object.keys(nodes).forEach(function (key) {
        var node = nodes[key];
        
        self.nodes[node.dataset.name] = node;
    });
};

/**
 * Enable component for modification
 */
Component.prototype.enable = function () {
    utils.each(this.nodes, mini_blog.dom.makeEditable);
};

/**
 * Disable component for modification
 */
Component.prototype.disable = function () {
    utils.each(this.nodes, mini_blog.dom.unmakeEditable);
};

/**
 * Save and cancel component 
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

    utils.each(this.nodes, function (node) {
        data[node.dataset.name] = node.innerHTML;
    });
    
    return data;
};

module.exports = Component;