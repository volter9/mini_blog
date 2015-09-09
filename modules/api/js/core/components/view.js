var Fields = require('../fields'),
    View   = require('../../mvc/view'),
    extend = require('../../helpers/extend'),
    utils  = require('../../helpers/utils'),
    dom    = require('../../helpers/dom');

module.exports = View.extend({
    /**
     * Initialize the view
     */
    initialize: function () {
        this.fields = this.fields || {};
        this.nodes  = this.nodes  || {};
        this.lang   = this.lang   || {};
        
        this.initiateFields(this.node, this.fields);
        this.initiateForm(this.nodes);
        
        this.data.model.on('change', this.render.bind(this));
        this.render();
    },
    
    /**
     * Setup fields
     * 
     * @param {Node} node
     * @param {Object} fields
     */
    initiateFields: function (node, fields) {
        var self = this;
        
        utils.each(fields, function (field, name) {
            var type   = field.type,
                target = dom.find(field.target, node);
            
            field.name = name;
            
            self.nodes[name] = new Fields[type](target, field, self.lang[name]);
        });
    },
    
    initiateForm: function (nodes) {
        var self = this;
        
        this.form = dom.node('<div class="m-hidden"></div>');
        
        utils.each(nodes, function (field) {
            self.form.appendChild(field.field);
        });
        
        this.node.insertBefore(this.form, this.node.children[0]);
    },
    
    /**
     * Render the data
     */
    render: function () {
        var data = this.data.model.all();
        
        utils.each(this.nodes, function (node, key) {
            if (key in data) {
                node.set(data[key]);
            }
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
        this.node.classList.add('m-editing');
        this.form.classList.remove('m-hidden');
        
        utils.each(this.nodes, function (node) {
            node.activate();
        });
    },
    
    /**
     * Deactivate the view
     */
    deactivate: function () {
        this.node.classList.remove('m-editing');
        this.form.classList.add('m-hidden');
        
        utils.each(this.nodes, function (node) {
            node.deactivate();
        });
    }
});