/**
 * Base field prototype
 * 
 * @param {Node} node
 * @param {String} name
 */
var Field = function (node, options) {
    this.options = options;
    
    this.field = this.create(node);
    this.name  = options.name;
    this.node  = node;
    
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

module.exports = Field;