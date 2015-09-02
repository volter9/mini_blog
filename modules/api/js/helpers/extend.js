var utils = require('./utils');

/**
 * Helper function to make it easily extend other prototypes
 * 
 * @param {Function} proto
 * @return {Function}
 * @author volter9
 */
var extend = function (proto) {
    /**
     * @param {Object} options
     * @return {Function}
     */
    return function (options) {
        var ctor = options.constructor;
        
        var F = function () {            
            proto.apply(this, arguments);
            
            ctor && ctor.apply(this, arguments);
        };
        
        F.prototype = Object.create(proto.prototype);
        
        utils.each(options, function (value, key) {
            if (key === 'constructor') { 
                return;
            }
            
            F.prototype[key] = value;
        });
        
        F.extend = extend(F);
        
        return F;
    };
};

module.exports = extend;