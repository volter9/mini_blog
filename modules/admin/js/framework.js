/**
 * Simple MVC JS framework specially suited for 
 * mini_blog development, inspired by Backbone.js
 * 
 * @package mini_blog
 */

var mvc = {};

/**
 * Helper function to make it easily extend other prototypes
 * 
 * @param {Function} proto
 * @return {Function}
 */
mvc.extend = function (proto) {
    /**
     * Closure
     * 
     * @param {Object} options
     * @return {Function}
     */
    return function (options) {
        var F = function () {
            proto.apply(this, mini_blog.toArray(arguments));
        };
        
        F.prototype = Object.create(proto.prototype);
        
        mini_blog.each(options, function (value, key) {
            F.prototype[key] = value;
        });
    
        return F;
    };
};

/**
 * Data Mapper
 * 
 * Its responsibility is to fetch, save and map data to specific model
 */
mvc.mapper = (function () {
    var ajax = mini_blog.ajax;
    
    var Mapper = function (options) {
        this.options = mini_blog.utils.merge({
            baseurl: '/',
            model:   mvc.model
        }, options);
        
        this.models = [];
    };
    
    mini_blog.events(Mapper.prototype);
    
    /**
     * Parse the result 
     * 
     * @param {Object} data
     * @return {Object}
     */
    Mapper.prototype.parse = function (data) {
        return data;
    };
    
    /**
     * Fetch a model from server
     * 
     * @param {Number} id
     */
    Mapper.prototype.fetch = function (id) {
        var self = this;
        
        ajax.get([this.options.baseurl, 'get', id])
            .success(function (_, data) {
                var model = new self.options.model(self.parse(data));
                
                self.models.push(model);
                self.emit('add', model);
            })
            .send();
    };
    
    /**
     * Create a model and send it to server
     * 
     * @param {Object} data
     */
    Mapper.prototype.create = function (data) {
        var self = this;
        
        ajax.post([this.options.baseurl, 'add'], data)
            .success(function (_, response) {
                data.id = response.id;
                
                var model = new self.options.model(data);
                
                self.models.push(model);
                self.emit('add', model);
            })
            .send();
    };
    
    /**
     * Update (edit) the model
     * 
     * @param {mvc.model} model
     */
    Mapper.prototype.update = function (model) {
        var self = this;
        
        ajax.post([this.options.baseurl, 'edit', model.id], model.all())
            .success(function () {
                self.emit('change', model);
            })
            .send();
    };
    
    /**
     * Remove model from database
     * 
     * @param {Number} id
     */
    Mapper.prototype.remove = function (id) {
        var self = this;
        
        ajax.post([this.options.baseurl, 'remove', id])
            .success(function () {
                self.emit('destroy');
            })
            .send();
    };
    
    /**
     * Get the model by id
     * 
     * @param {Number} id
     * @return {mvc.model
     */
    Mapper.prototype.get = function (id) {
        return this.models.filter(function (model) {
            return model.id === id;
        });
    };
    
    Mapper.extend = mvc.extend(Mapper);
    
    return Mapper;
})();

/**
 * MVC model
 * 
 * Responsible for 
 */
mvc.model = (function () {
    var Model = function (data) {
        var id = -1;
        
        if (data && data.id) {
            id = data.id;
            
            delete data.id;
        }
        
        this.data = mini_blog.utils.merge(this.data || {}, data || {});
        this.id   = id;
    };
    
    mini_blog.events(Model.prototype);
    
    /**
     * Get the value by key in the model
     * 
     * @param {String} key
     * @return {Object}
     */
    Model.prototype.get = function (key) {
        return this.data[key] ? this.data[key] : false;
    };
    
    /**
     * Set the value by key
     * 
     * @param {String} key
     * @param {Object} value
     */
    Model.prototype.set = function (key, value) {
        if (key && typeof value !== 'undefined') {
            this.data[key] = value;
        }
        else {
            this.data = mini_blog.utils.merge(this.data, key);
        }
        
        this.emit('change', this);
    };
    
    /**
     * Get all data from 
     * 
     * @return {Object}
     */
    Model.prototype.all = function () {
        return mini_blog.utils.merge(this.data, {});
    };
    
    /**
     * Destroy the model
     */
    Model.prototype.destroy = function () {
        this.data = {};
        this.id   = -1;
        
        this.emit('destroy');
    };
    
    /**
     * Reset model with new set of data
     * 
     * @param {Object} data
     */
    Model.prototype.reset = function (data) {
        this.data = data;
        
        this.emit('change', this);
    };
    
    Model.extend = mvc.extend(Model);
    
    return Model;
})();

/**
 * MVC view
 * 
 * This class is responsible for rendering data from models
 */
mvc.view = (function () {
    var View = function (node) {
        this.node = node;
        
        this.initialize();
    };
    
    View.prototype.initialize = function () {};
    View.prototype.render = function () {};
    
    View.extend = mvc.extend(View);
    
    return View;
})();