var dom   = require('v-utils/dom'),
    Field = require('./field');

module.exports = Field.extend({
    create: function (node) {
        var text = dom.node(
            '<input class="m-input-field m-field"' + 
            ' placeholder="' + this.title + '">'
        );
    
        if (node) {
            text.className += ' ' + node.className;
        }
    
        return text;
    },

    activate: function () {
        if (this.node) {
            this.node.classList.add('m-hidden');
        }
    },

    deactivate: function () {
        if (this.node) {
            this.node.classList.remove('m-hidden');
        }
    }
});