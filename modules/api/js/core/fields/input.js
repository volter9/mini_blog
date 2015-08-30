var dom   = require('../../helpers/dom'),
    Field = require('./field');

var Input = function () {
    Field.apply(this, arguments);
};

Input.prototype = Object.create(Field.prototype);

Input.prototype.create = function (node) {
    var text = dom.node('<input class="m-input-field m-field">');
    
    if (node) {
        text.className += ' ' + node.className;
    }
    
    return text;
};

Input.prototype.activate = function () {
    if (this.node) {
        this.node.classList.add('m-hidden');
    }
};

Input.prototype.deactivate = function () {
    if (this.node) {
        this.node.classList.remove('m-hidden');
    }
};

module.exports = Input;