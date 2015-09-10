var components = require('../components/collection'),
    editor     = require('../editor'),
    ajax       = require('v-utils/ajax'),
    dom        = require('v-utils/dom'),
    view       = require('v-mvc/view');

var AddView = view.extend({
    /**
     * Bind the action 
     */
    initialize: function () {
        this.bind('.button', 'click', this.addView);
    },
    
    /**
     * Add a view
     */
    addView: function (event) {
        event.preventDefault();
        
        if (!editor.editing) {
            this.createNode(dom.find('.posts'));
        }
    },
    
    /**
     * Create a node from template requested via AJAX
     * 
     * @param {Node} destination
     */
    createNode: function (destination) {
        if (!destination) {
            return;
        }
        
        var self = this;
        var callback = function (xhr, data) {
            self.appendNode(data, destination);
        };
        
        ajax.post('api/template/posts')
            .success(callback)
            .send();
    },
    
    /**
     * Add a node, this function serves as callback
     * 
     * @param {Object} data
     * @param {Node} destination
     */
    appendNode: function (data, destination) {
        var div = dom.node(data.html);
        
        div.removeAttribute('data-id'); 
        
        destination.insertBefore(div, destination.children[0]);
        
        components.createComponent(div);
        
        div.component.post.merge(data.data);
        div.editor.edit();
    }
});

module.exports = new AddView(dom.find('#mini_panel .add'));