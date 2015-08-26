var View   = require('../../mvc/view'),
    utils  = require('../../helpers/utils'),
    extend = require('../../mvc/extend'),
    fields = require('../fields');

var ComponentView = View.extend({
    /**
     * Initialize the view
     */
    initialize: function () {
        this.nodes = {};
        this.setNodes(this.node);
        
        this.data.model.on('change', this.render.bind(this));
    },
    
    /**
     * Render the data
     */
    render: function () {
        var data = this.data.model.all();
        
        utils.each(this.nodes, function (node, key) {
            data[key] && (node.view.innerHTML = data[key]);
        });
    },
    
    /**
     * Setup nodes
     * 
     * @param {Node} node
     */
    setNodes: function (node) {
        var nodes = utils.toArray(node.querySelectorAll('[data-name]')),
            self = this;
    
        nodes.forEach(function (node) {
            var name = node.dataset.name,
                type = node.dataset.type || 'input';
            
            node.dataset.type = type;
            
            self.nodes[node.dataset.name] = {
                view: node,
                edit: fields[type].create(node)
            };
        });
    },
    
    /**
     * Collect data from component nodes
     * 
     * @return {Object}
     */
    collectData: function () {
        var data = {};

        utils.each(this.nodes, function (node) {
            data[node.view.dataset.name] = node.edit.value;
        });
    
        return data;
    },
    
    activate: function () {
        utils.each(this.nodes, function (node) {
            fields[node.view.dataset.type].activate(node.edit, node.view);
        });
    },
    
    deactivate: function () {
        utils.each(this.nodes, function (node) {
            fields[node.view.dataset.type].deactivate(node.edit, node.view);
        });
    }
});

ComponentView.extend = extend(ComponentView);

module.exports = ComponentView;