var dom   = require('../../helpers/dom'),
    Input = require('./Input');

var Text = function () {
    Input.apply(this, arguments);
};

Text.prototype = Object.create(Input.prototype);

Text.prototype.create = function (node) {
    var text = dom.node('<textarea class="m-text-field m-hidden"></textarea>');
    
    if (node) {
        text.className += ' ' + node.className;
    }
    
    return text;
};

Text.prototype.activate = function () {
    Input.prototype.activate.call(this);
    
    this.field.style.height = this.field.scrollHeight + 6 + 'px';
};

module.exports = Text;