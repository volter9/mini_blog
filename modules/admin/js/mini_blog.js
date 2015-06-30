/**
 * mini_blog.js
 * 
 * JS library for inline edit and other stuff for mini_blog
 * 
 * @author volter9
 * @package mini_blog
 */

var mini_blog = {};

/**
 * Helpers
 */

/**
 * AJAX helper function
 * 
 * @param {String} url
 * @param {String} method
 * @param {Object} data
 * @param {Function} callback
 */
mini_blog.ajax = function (url, method, data, callback) {
    var request = new XMLHttpRequest,
        query = mini_blog.ajax.query(data);
    
    method = (method || 'GET').toUpperCase();
    
    if (method === 'GET') {
        url += (url.indexOf('?') === -1 ? '?' : '&') + query;
    }
    
    request.open(method, url);
    
    request.onreadystatechange = function () {
        callback(this, request.readyState, request.status);
    };
    
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    
    console.log(method !== 'GET' ? query : '');
    
    request.send(query);
};

/**
 * Encode object into query string
 * 
 * @param {Object} object
 * @return {String}
 */
mini_blog.ajax.query = function (object) {
    var result = '',
        keys   = Object.keys(object),
        length = keys.length;
    
    keys.forEach(function (v, k) {
        var string = v + '=' + encodeURIComponent(object[v]);
        
        result += string + (k !== length - 1 ? '&' : '');
    });
    
    return result;
};