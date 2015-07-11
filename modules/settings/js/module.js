/**
 * @param {Object} attributes
 * @param {Node} node
 */
var Settings = function (attributes, node) {
    this.name = 'settings';
    this.group = node.getAttribute('data-group');
    
    mini_blog.component.call(this, attributes, node);
};

Settings.prototype = Object.create(mini_blog.component.prototype);

/**
 * Save settings
 * 
 * @param {Function} callback
 */
Settings.prototype.save = function (callback) {
    var url = ['admin', this.name, this.group],
        data = this.collectData();
    
    mini_blog.ajax.post(url, data)
                  .success(callback)
                  .send();
};

mini_blog.components.register('settings', Settings);