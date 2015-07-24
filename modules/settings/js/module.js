/**
 * Setting view
 */
var SettingsView = mini_blog.mvc.view.extend({
    /**
     * Initialize view
     */
    initialize: function () {
        this.data.setting.on('change', this.render.bind(this));
    },
    
    /**
     * Render the view
     */
    render: function () {
        var data = this.data.setting.all();
        
        mini_blog.each(this.data.nodes, function (node, key) {
            if (data[key]) node.innerHTML = data[key];
        });
    }
});

var setting = new mini_blog.mvc.model;

/**
 * @param {Object} attributes
 * @param {Node} node
 */
var Settings = function (attributes, node) {
    mini_blog.component.call(this, attributes, node);
};

Settings.prototype = Object.create(mini_blog.component.prototype);

/**
 * Initialize the setting
 */
Settings.prototype.initialize = function () {
    var self = this;
    
    this.group = this.node.getAttribute('data-group');
    this.view  = new SettingsView(this.node, {
        setting: setting,
        nodes:   this.nodes
    });
    
    mini_blog.each(this.nodes, function (node, key) {
        setting.set(key, node.innerHTML);
    });
};

/**
 * Save settings to the server
 */
Settings.prototype.save = function () {
    var url  = ['admin/settings/save', this.group],
        data = this.collectData(),
        ajax = mini_blog.ajax;
    
    ajax.post(url, data)
        .success(function () { 
            setting.merge(data);
            setting.clear();
        })
        .send();
};

mini_blog.components.register('settings', Settings);