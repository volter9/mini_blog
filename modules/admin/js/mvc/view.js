var extend = require('./extend');

/**
 * MVC view
 * 
 * This class is responsible for rendering data from models
 */
var View = function (node) {
    this.node = node;
    
    this.initialize();
};

/** Methods that should be extended in subclasses */
View.prototype.initialize = function () {};
View.prototype.render = function () {};

View.extend = extend(View);

module.exports = View;