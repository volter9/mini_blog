var dom   = require('../../helpers/dom'),
    Field = require('./field');

var Text = function () {
    Field.apply(this, arguments);
};

Text.prototype = Object.create(Field.prototype);

Text.prototype.create = function (node) {
    var text = document.createElement('textarea');
    
    text.classList.add('m-text-field');
    text.classList.add('m-hidden');
    
    text.value = node.innerHTML.trim();
    text.className += ' ' + node.className;
    
    dom.insertAfter(node, text);
    
    return text;
};

Text.prototype.activate = function () {
    this.field.classList.add('m-editable');
    this.field.classList.remove('m-hidden');
    
    this.node.classList.add('m-hidden');
};

Text.prototype.deactivate = function () {
    this.field.classList.remove('m-editable');
    this.field.classList.add('m-hidden');
    
    this.node.classList.remove('m-hidden');
};

module.exports = Text;