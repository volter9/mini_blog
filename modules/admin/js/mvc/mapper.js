var events = require('../helpers/events'),
    utils = require('../helpers/utils'),
    ajax   = require('../helpers/ajax'),
    extend = require('./extend'),
    model  = require('./model');

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
    
    this.models = [];
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
    }).pop();
};

/**
 * Synchronize with the server
 * 
 * 
 */
Mapper.prototype.sync = function () {
    
};

Mapper.extend = extend(Mapper);

module.exports = Mapper;