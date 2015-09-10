var components = require('./components/collection'),
    settings   = require('./settings'),
    utils      = require('v-utils/utils'),
    dom        = require('v-utils/dom');

/**
 * Initialize the system
 * 
 * @param {Object} meta - settings
 */
module.exports = function (meta) {
    settings.assign(meta);
    
    require('v-utils/ajax').base_url = settings.get('baseurl');
    
    utils.toArray(dom.findAll('[data-component]'))
         .forEach(components.createComponent);
};