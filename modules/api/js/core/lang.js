var data = null;

module.exports = function (key, returnKey) {
    if (typeof key === 'undefined') {
        return data;
    }
    
    if (typeof key !== 'string') {
        data = key;
        
        return;
    }
    
    var cursor = data;
    
    key.split('.').forEach(function (segment) {
        if (typeof cursor !== 'undefined') {
            cursor = cursor[segment];
        }
    });
    
    if (typeof cursor === 'undefined' && returnKey) {
        return key;
    }
    
    return cursor;
};