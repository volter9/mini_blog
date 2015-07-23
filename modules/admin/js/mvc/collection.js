var utils  = require('../helpers/utils'),
    extend = require('./extend');

/**
 * Model collection
 */
var Collection = function (options) {
    this.options = options;
    this.models  = {};
};

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
 * @param {Number} id
 * @param {Model} model
 */
Collection.prototype.add = function (id, model) {
    this.models[id] = model;
};

/**
 * Remove the model by id from collection
 * 
 * @param {Number} id
 */
Collection.prototype.remove = function (id) {
    delete this.models[id];
};

/**
 * Bootstrap the collection 
 * 
 * @param {Array} models
 */
Collection.prototype.bootstrap = function (models) {};

/**
 * Iteration of colleciton
 * 
 * @param {Function} callback
 */
Collection.prototype.forEach = function (callback) {
    utils.each(this.models, callback);
};

Collection.extend = extend(Collection);

module.exports = Collection;