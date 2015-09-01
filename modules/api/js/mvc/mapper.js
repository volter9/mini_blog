var events = require('../helpers/events'),
    extend = require('../helpers/extend'),
    utils  = require('../helpers/utils'),
    Model  = require('./model');

/* Default properties */
var defaults = {
    baseurl: '/',
    adapter: require('./adapters/ajax'),
    model:   Model,
    
    get:    'get',
    insert: 'add',
    update: 'edit',
    remove: 'remove',
};

/**
 * Mapper constructor
 * 
 * @param {Object} options
 */
var Mapper = function (options) {
    this.options = utils.merge(defaults, options);
    this.adapter = this.options.adapter;
};

events(Mapper.prototype);

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
 * Create a model and send it to server
 * 
 * @param {Object} data
 * @param {Model} model
 */
Mapper.prototype.create = function (data, model) {
    if (model && model instanceof Model) {
        model.merge(data);
        
        return model;
    }
    else {
        return new this.options.model(data);
    }
};

/**
 * Fetch a model from server
 * 
 * @param {Number} id
 * @param {Model} model
 * @param {Function} callback
 */
Mapper.prototype.fetch = function (id, model, callback) {
    this.adapter.fetch(this, id, model, callback);
};

/**
 * Send a model on server
 * 
 * @param {Model} model
 * @param {Function} callback
 */
Mapper.prototype.insert = function (model, callback) {
    this.adapter.insert(this, model, callback);
};

/**
 * Update (edit) the model
 * 
 * @param {Model} model
 * @param {Function} callback
 */
Mapper.prototype.update = function (model, callback) {
    this.adapter.update(this, model, callback);
};

/**
 * Save (insert or update) model
 * 
 * @param {Model} model
 * @param {Function} callback
 */
Mapper.prototype.save = function (model, callback) {
    model.isNew() 
        ? this.insert(model, callback) 
        : this.update(model, callback);
};

/**
 * Remove model from database
 * 
 * @param {Model} model
 * @param {Function} callback
 */
Mapper.prototype.remove = function (model, callback) {
    this.adapter.remove(this, model, callback);
};

/**
 * Synchronize with the server
 * 
 * @param {Collection} collection
 */
Mapper.prototype.sync = function (collection) {
    collection.forEach(function (model) {
        if (model.isNew()) {
            self.insert(model);
        }
        else if (model.isEmpty()) {
            self.remove(model);
            
            collection.remove(model.id);
        }
        else if (model.isDirty()) {
            self.update(model);
        }
    });
};

Mapper.extend = extend(Mapper);

module.exports = Mapper;