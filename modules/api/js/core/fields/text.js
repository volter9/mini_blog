var dom   = require('../../helpers/dom'),
    Input = require('./input');

module.exports = Input.extend({
    create: function (node) {
        var text = dom.node(
            '<textarea class="m-text-field m-field" ' +
            'placeholder="' + this.title + '"></textarea>'
        );
    
        if (node) {
            text.className += ' ' + node.className;
        }
    
        return text;
    },

    activate: function () {
        Input.prototype.activate.call(this);
    
        this.field.style.height = this.field.scrollHeight + 6 + 'px';
    }
});