var view       = require('../../mvc/view'),
    ajax       = require('../../helpers/ajax'),
    components = require('../components');

var AddView = view.extend({
    /**
     * Bind the action 
     */
    initialize: function () {
        this.find('.button').addEventListener('click', this.addView.bind(this));
    },
    
    /**
     * Add a view
     */
    addView: function (event) {
        event.preventDefault();
        
        this.createNode(document.querySelector('.posts'));
    },
    
    /**
     * Create a node from template requested via AJAX
     * 
     * @param {String} item
     * @param {Node} destination
     */
    createNode: function (destination) {
        var self = this;
        var callback = function (xhr, data) {
            self.appendNode(data, destination);
        };
        
        ajax.post('admin/template/posts')
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
        var fragment = document.createElement('div');
        
        fragment.innerHTML = data.html;
    
        var div = fragment.children[0];
    
        div.removeAttribute('data-id');    
        
        destination.insertBefore(div, destination.children[0]);
        
        components.createComponent(div);
        
        div.component.post.merge(data.data);
        div.editor.find('.edit-button').click()
    }
});

module.exports = new AddView(document.querySelector('#mini_panel .add'));