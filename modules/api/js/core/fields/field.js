var Field = function (node, model) {
    this.field = this.create(node, model);
    this.name  = node.dataset.name;
    this.node  = node;
};

Field.prototype.create = function (node, model) {
    return node;
};

Field.prototype.activate = function () {};
Field.prototype.deactivate = function () {};

Field.prototype.value = function () {
    return this.field.value;
};

module.exports = Field;