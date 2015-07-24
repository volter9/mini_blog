var events = require('../helpers/events'),
    utils  = require('../helpers/utils'),
    ajax   = require('../helpers/ajax'),
    extend = require('./extend'),
    model  = require('./model');

/* Default properties */
var defaults = {
    baseurl: '/',
    model:   model
};

/**
 * Mapper constructor
 * 
 * @param {Object} options
 */
var Mapper = function (options) {
    this.options = utils.merge(defaults, options);
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
 */
Mapper.prototype.create = function (data) {
    return new self.options.model(data);
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
            self.emit('get', new self.options.model(self.parse(data)));
        })
        .send();
};

/**
 * Send a model on server
 * 
 * @param {Model} model
 */
Mapper.prototype.insert = function (model) {
    var self = this;
    
    ajax.post([this.options.baseurl, 'add'], model.data())
        .success(function (_, data) {
            model.id = data.id;
            
            self.emit('add', model);
        })
        .send();
};

/**
 * Update (edit) the model
 * 
 * @param {Model} model
 */
Mapper.prototype.update = function (model) {
    var self = this;
    
    ajax.post([this.options.baseurl, 'edit', model.id], model.delta())
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
            self.emit('destroy', id);
        })
        .send();
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