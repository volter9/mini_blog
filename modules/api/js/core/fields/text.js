var dom   = require('../../helpers/dom'),
    Input = require('./Input');

var Text = function () {
    Input.apply(this, arguments);
};

Text.prototype = Object.create(Input.prototype);

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
    Input.prototype.activate.call(this);
    
    this.field.style.height = this.field.scrollHeight + 6 + 'px';
};

module.exports = Text;