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
            data[key] && (node.node.innerHTML = data[key]);
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
            
            self.nodes[node.dataset.name] = new fields[node.dataset.type](node);
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
            data[node.name] = node.value();
        });
    
        return data;
    },
    
    /**
     * Activate the view
     */
    activate: function () {
        utils.each(this.nodes, function (node) {
            node.activate();
        });
    },
    
    deactivate: function () {
        utils.each(this.nodes, function (node) {
            node.deactivate();
        });
    }
});

ComponentView.extend = extend(ComponentView);

module.exports = ComponentView;