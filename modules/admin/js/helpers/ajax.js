var settings = require('../core/settings');

/**
 * Central AJAX control
 */
var ajax = {};

/**
 * Requests
 * 
 * @param {String} url
 * @param {String} method
 * @param {Object} data
 */
ajax.request = function (url, method, data) {
    var request = new this.instance(this.url(url), method, data);
    
    request.on('data', function (xhr, data) {
        if (data.status === 'ok') {
            return;
        }
        
        request.emit('error', xhr, data.message);
    });
    
    request.on('error', function (xhr, message) {
        console.log(message);
    });
    
    return request;
};

/** AJAX shortcuts */
['get', 'post', 'put', 'delete'].forEach(function (method) {
    var name = method.toUpperCase();
    
    ajax[method] = function (url, data) {
        return this.request(url, name, data);
    };
});

/**
 * Convert relative url to full url
 * 
 * Empty string is needed to avoid ugly `('/' + url.join('/'))`
 * snippet
 * 
 * @param {String|Array} url
 * @return {String}
 */
ajax.url = function (url) {
    url = Array.isArray(url)
        ? ['', settings.get('baseurl')].concat(url)
        : ['', settings.get('baseurl'), url];
    
    return url.join('/').replace(/\/+/, '/');
};

ajax.instance = require('./ajax_instance');

module.exports = ajax;