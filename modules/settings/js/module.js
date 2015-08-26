(function () {
    var View = mini_blog.component.view;
    
    /* Posts mapper */
    var mapper = new mini_blog.mvc.mapper({
        baseurl: 'api/settings',
        update:  'save'
    });
    
    mapper.parse = function (data) {
        return data.settings;
    };
    
    /* Settings collection */
    var settings = new mini_blog.mvc.collection;
    
    settings.bindTo(mapper);
    
    /**
     * Setting view
     */
    var SettingsView = View.extend({});
    
    /**
     * Settings prototype
     * 
     * @param {Object} attributes
     * @param {Node} node
     */
    var Settings = function (node) {
        mini_blog.component.call(this, node);
    };

    Settings.prototype = Object.create(mini_blog.component.prototype);

    /**
     * Initialize the setting
     */
    Settings.prototype.initialize = function () {
        this.group        = this.node.dataset.group;
        this.notRemovable = true;
        
        this.setting = settings.get(this.group) || mapper.create();
        
        if (this.setting.isEmpty()) {
            mapper.fetch(this.group, this.setting);
        }
        
        this.createView();
    };
    
    /**
     * Create a view 
     * 
     * @param {mini_blog.mvc.model} setting
     */
    Settings.prototype.createView = function () {
        this.view = new SettingsView(this.node, {
            model: this.setting
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
        this.setting.merge(this.view.collectData());
        
        mapper.update(this.setting);
        
        this.setting.clear();
    };

    mini_blog.components.register('settings', Settings);
    mini_blog.settings = {
        collection: settings
    };
})();