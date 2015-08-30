var utils  = require('../utils'),
    events = require('../events');

/**
 * AJAX constructor
 * 
 * @param {String} url
 * @param {String} method
 * @param {Object} data
 */
var Request = function (url, method, data) {
    this.method  = method || 'GET';
    this.data    = data   || {};
    this.url     = url;
    this.headers = {
        'Content-type':     'application/x-www-form-urlencoded',
        'X-Requested-With': 'XMLHttpRequest'
    };
};

/**
 * Send AJAX request
 */
Request.prototype = {
    /**
     * Send the request
     */
    send: function () {
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
            self.emit('error', request, 'Connection error');
        };
    
        utils.each(this.headers, function (value, key) {
            request.setRequestHeader(key, value);
        });
    
        request.send(query);
    },

    /**
     * Set success handler
     * 
     * @param {Function} handler
     */
    success: function (handler) {
        this.on('success', handler);
    
        return this;
    },

    /**
     * Set error handler
     * 
     * @param {Function} handler
     */
    error: function (handler) {
        this.on('error', handler);
    
        return this;
    },

    /**
     * Set request header
     * 
     * @param {String} name
     * @param {String} value
     */
    header: function (name, value) {
        this.headers[name] = value;
    
        return this;
    },

    /**
     * Encode object into query string
     * 
     * @param {Object} object
     * @return {String}
     */
    query: function (object) {
        var result = '',
            keys = Object.keys(object);
    
        keys.forEach(function (v, k) {
            result += encodeURIComponent(v) 
                   + '=' 
                   + encodeURIComponent(object[v]) + '&';
        });
    
        return result.substr(0, result.length - 1);
    }
};

events(Request.prototype);

module.exports = Request;