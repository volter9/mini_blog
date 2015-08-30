var utils  = require('../helpers/utils'),
    events = require('../helpers/events'),
    extend = require('../helpers/extend'),
    Model  = require('./model');

/**
 * Model collection
 * 
 * @param {Object} models
 */
var Collection = function (models) {
    this.models = models || {};
};

events(Collection.prototype);

/**
 * Get the model by id
 * 
 * @param {Number} id
 * @return {Model}
 */
Collection.prototype.get = function (id) {
    return this.models[id];
};

/**
 * Add a model to the collection
 * 
 * @param {Model} model
 */
Collection.prototype.add = function (model) {
    this.models[model.id] = model;
    
    this.emit('add', model);
};

/**
 * Remove the model by id from collection
 * 
 * @param {Number} id
 */
Collection.prototype.remove = function (id) {
    var model = this.models[id];
    
    delete this.models[id];
    
    this.emit('remove', model);
};

/**
 * Bootstrap the collection 
 * 
 * @param {Array} models
 */
Collection.prototype.bootstrap = function (models) {
    var self = this;
    
    var callback = function (data, id) {
        data.id = data.id || id;
        
        var model = new Model(data);
        
        self.models[model.id] = model;
    };
    
    Array.isArray(models)
        ? models.forEach(callback)
        : utils.each(models, callback);
};

/**
 * Iteration of colleciton
 * 
 * @param {Function} callback
 */
Collection.prototype.forEach = function (callback) {
    utils.each(this.models, callback);
};

/**
 * Bind mapper to collection
 * 
 * @param {Mapper} mapper
 */
Collection.prototype.bindTo = function (mapper) {
    var add = this.add.bind(this);
    
    mapper.on('get', add);
    mapper.on('add', add);
    mapper.on('remove', this.remove.bind(this));
};

Collection.extend = extend(Collection);

module.exports = Collection;