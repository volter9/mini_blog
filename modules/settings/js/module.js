(function () {
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
                data[key] && (node.innerHTML = data[key]);
            });
        }
    });

    var mapper = new mini_blog.mvc.mapper({
        baseurl: 'admin/settings',
        update:  'save',
        get:     'get'
    });
    
    mapper.parse = function (data) {
        return data.settings;
    };
    
    var settings = new mini_blog.mvc.collection;

    /**
     * Settings prototype
     * 
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
        var self = this,
            setting = settings.get(this.group);
        
        var callback = function (model) {
            console.log(model);
            
            if (model.id === self.group && !self.view) {
                self.createView(model);
            }
        };
        
        this.group = this.node.getAttribute('data-group');
        this.notRemovable = true;
        
        if (setting) {
            callback(setting);
        }
        else {
            mapper.on('get', callback);
            mapper.fetch(this.group);
        }
    };
    
    /**
     * Create a view 
     * 
     * @param {mini_blog.mvc.model} setting
     */
    Settings.prototype.createView = function (setting) {
        this.setting = setting;
        
        this.view = new SettingsView(this.node, {
            setting: setting,
            nodes:   this.nodes
        });
    };
    
    /**
     * Cancel the modifications
     */
    Settings.prototype.cancel = function () {
        this.setting.revert();
    };

    /**
     * Save settings to the server
     */
    Settings.prototype.save = function () {
        this.setting.merge(this.collectData());
        
        mapper.update(this.setting);
    };

    mini_blog.components.register('settings', Settings);
})();