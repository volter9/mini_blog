var events = require('../helpers/events'),
    utils  = require('../helpers/utils'),
    extend = require('./extend');

/**
 * @param {Object} data
 */
var Model = function (data) {
    var id = -1;
    
    if (data && data.id) {
        id = data.id;
        
        delete data.id;
    }
    
    data = utils.merge(this.data || {}, data || {});
    
    this.previous = data;
    this.data     = data;
    this.id       = id;
};

events(Model.prototype);

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
 * Check whether the model is new
 * 
 * @return {Boolean}
 */
Model.prototype.isNew = function () {
    return this.id > 0;
};

/**
 * Check whether the model was modified
 * 
 * @return {Boolean}
 */
Model.prototype.isDirty = function () {
    
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
        this.data = utils.merge(this.data, key);
    }
    
    this.emit('change', this);
};

/**
 * Get all data from 
 * 
 * @return {Object}
 */
Model.prototype.all = function () {
    return utils.merge(this.data, {});
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

Model.extend = extend(Model);

module.exports = Model;