var dom   = require('../../helpers/dom'),
    Field = require('./field');

var Input = function () {
    Field.apply(this, arguments);
};

Input.prototype = Object.create(Field.prototype);

Input.prototype.create = function (node) {
    var text = document.createElement('input');
    
    text.classList.add('m-input-field');
    text.classList.add('m-hidden');
    
    text.value = node.innerHTML.trim();
    text.className += ' ' + node.className;
    
    dom.insertAfter(node, text);
    
    return text;
};

Input.prototype.activate = function () {
    this.field.classList.add('m-editable');
    this.field.classList.remove('m-hidden');
    
    this.node.classList.add('m-hidden');
};

Input.prototype.deactivate = function () {
    this.field.classList.remove('m-editable');
    this.field.classList.add('m-hidden');
    
    this.node.classList.remove('m-hidden');
};

module.exports = Input;