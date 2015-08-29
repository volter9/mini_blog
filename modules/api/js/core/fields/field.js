/**
 * Base field prototype
 * 
 * @param {Node} node
 * @param {Model} model
 */
var Field = function (node, model) {
    this.field = this.create(node, model);
    this.name  = node.dataset.name;
    this.node  = node;
};

/**
 * Create a field for editing 
 * 
 * @param {Node} node
 * @param {Model} model
 * @return {Node}
 */
Field.prototype.create = function (node, model) {
    return node;
};

Field.prototype.activate = function () {};
Field.prototype.deactivate = function () {};


Field.prototype.value = function () {
    return this.field.value;
};

module.exports = Field;