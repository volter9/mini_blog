var extend = require('./extend');

/**
 * MVC view
 * 
 * This class is responsible for rendering data from models
 * 
 * @param {Node} node
 * @param {Object} data
 */
var View = function (node, data) {
    this.node = node;
    this.data = data;
    
    this.initialize();
};

/** Methods that should be extended in subclasses */
View.prototype.initialize = function () {};
View.prototype.render = function () {};

View.extend = extend(View);

module.exports = View;