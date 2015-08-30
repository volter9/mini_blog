var components = require('./components/collection'),
    settings   = require('./settings'),
    utils      = require('../helpers/utils'),
    dom        = require('../helpers/dom');

/**
 * Initialize the system
 * 
 * @param {Object} meta - settings
 */
module.exports = function (meta) {
    settings.assign(meta);
    
    utils.toArray(dom.findAll('[data-component]'))
         .forEach(components.createComponent);
};