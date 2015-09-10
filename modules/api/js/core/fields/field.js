var extend = require('v-utils/extend');

/**
 * Base field prototype
 * 
 * @param {Node} node
 * @param {String} name
 */
var Field = function (node, options, title) {
    this.options = options;
    
    this.title = title || '';
    this.name  = options.name;
    this.node  = node;
    this.field = this.create(node);
    
    if (this.options.set) {
        this.set = this.options.set;
    }
};

/**
 * Create a field for editing 
 * 
 * @param {Node} node
 * @return {Node}
 */
Field.prototype.create = function (node) {
    return node;
};

/**
 * Set the value
 * 
 * @param {String} value
 */
Field.prototype.set = function (value) {
    this.field.value = value;
    
    if (this.node) {
        this.node.innerHTML = value;
    }
};

Field.prototype.activate = function () {};
Field.prototype.deactivate = function () {};

/**
 * Get the value of the field
 * 
 * @return {String}
 */
Field.prototype.value = function () {
    return this.field.value;
};

Field.extend = extend(Field);

module.exports = Field;