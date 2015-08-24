var ajax = require('../../helpers/ajax');

module.exports = {
    /**
     * Fetch an item from server
     * 
     * @param {Mapper} mapper
     * @param {Model|Number} model
     * @param {Fucntion}
     */
    fetch: function (mapper, model, callback) {
        var options = mapper.options,
            id      = !isNaN(model) ? model : model.id;
        
        ajax.get([options.baseurl, options.get, id])
            .success(function (_, data) {
                var isNew  = isNaN(model),
                    result = mapper.create(mapper.parse(data), model);
            
                if (!isNew) {
                    callback && callback(model);
                    mapper.emit('get', result);
                }
            })
            .send();
    },
    
    /**
     * Insert an item on server
     * 
     * @param {Mapper} mapper
     * @param {Model} model
     * @param {Fucntion}
     */
    insert: function (mapper, model, callback) {
        var options = mapper.options;
        
        ajax.post([options.baseurl, options.insert], model.all())
            .success(function (_, data) {
                model.id = data.id;
            
                callback && callback(model);
                mapper.emit('add', model);
            })
            .send();
    },
    
    /**
     * Update an item on server
     * 
     * @param {Mapper} mapper
     * @param {Model} model
     * @param {Fucntion}
     */
    update: function (mapper, model, callback) {
        var options = mapper.options;
        
        ajax.post([options.baseurl, options.update, model.id], model.diff())
            .success(function () {
                callback && callback(model);
                mapper.emit('update', model);
            })
            .send();
    },
    
    /**
     * Remove an item from server
     * 
     * @param {Mapper} mapper
     * @param {Model} model
     * @param {Fucntion}
     */
    remove: function (mapper, model, callback) {
        var options = mapper.options;
        
        ajax.post([options.baseurl, options.remove, model.id])
            .success(function () {
                callback && callback(model);
                mapper.emit('remove', model);
            })
            .send();
    }
};