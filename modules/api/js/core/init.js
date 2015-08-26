var components = require('./components/collection'),
    settings   = require('./settings'),
    utils      = require('../helpers/utils');

/**
 * Initialize the system
 * 
 * @param {Object} meta - settings
 */
var init = function (meta) {
    settings.assign(meta);
    
    utils.toArray(document.querySelectorAll('[data-component]'))
         .forEach(components.createComponent);
};

module.exports = init;