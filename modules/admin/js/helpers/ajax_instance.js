var ajax   = require('./ajax'),
    events = require('./events');

/**
 * AJAX constructor
 * 
 * @param {String} url
 * @param {String} method
 * @param {Object} data
 */
var Ajax = function (url, method, data) {
    this.method = method || 'GET';
    this.data   = data   || {};
    this.url    = url;
};

events(Ajax.prototype);

/**
 * Send AJAX request
 */
Ajax.prototype.send = function () {
    var request = new XMLHttpRequest;
    
    var method = this.method.toUpperCase(),
        query  = this.query(this.data),
        url    = this.url;
    
    var self = this;

    if (method === 'GET' && query) {
        url += (url.indexOf('?') === -1 ? '?' : '&') + query;
    }

    request.open(method, url);
    request.onreadystatechange = function () {
        var r = this.readyState,
            s = this.status,
            data;
        
        if (r === 4 && s === 200) {
            try {
                data = JSON.parse(this.responseText);
            }
            catch (e) {
                self.emit('error', request, 'Invalid JSON');
            }
            
            if (data) {
                self.emit('data', this, data);
            }
        }
    };
    
    request.onerror = function () {
        self.emit('error', request, 'AJAX Error');
    };
    
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    request.send(query);
};

/**
 * Set success handler
 * 
 * @param {Function} handler
 */
Ajax.prototype.success = function (handler) {
    this.on('data', handler);
    
    return this;
};

/**
 * Set error handler
 * 
 * @param {Function} handler
 */
Ajax.prototype.error = function (handler) {
    this.on('error', handler);
    
    return this;
};

/**
 * Encode object into query string
 * 
 * @param {Object} object
 * @return {String}
 */
Ajax.prototype.query = function (object) {
    var result = '',
        keys = Object.keys(object);
    
    keys.forEach(function (v, k) {
        result += encodeURIComponent(v) 
               + '=' 
               + encodeURIComponent(object[v]) + '&';
    });
    
    return result.substr(0, result.length - 1);
};

module.exports = Ajax;