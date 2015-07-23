var utils = require('../helpers/utils');

/**
 * @param {mini_blog.editor}
 */
function Mod (editor) {
    this.editor = editor;
    this.actions = {};
    
    this.init();
}

Mod.prototype.init = function () {};

/**
 * Enable mod
 */
Mod.prototype.enable = function () {
    utils.each(this.actions, function (action) {
        action.button.style.display = 'block';
    });
};

/**
 * Disable mod
 */
Mod.prototype.disable = function () {
    utils.each(this.actions, function (action) {
        action.button.style.display = 'none';
    });
};

/**
 * Add a named action
 * 
 * @param {String} name
 * @param {String} text
 * @param {Function} callback
 */
Mod.prototype.addAction = function (name, text, callback) {
    var button = document.createElement('button'),
        self = this;
    
    button.innerHTML = !callback ? name : text;
    button.setAttribute('data-role', name);
    button.className = 'button';
    
    button.addEventListener('click', function () {
        self.trigger(this.getAttribute('data-role'), self.editor.current);
    });
    
    this.editor.container.appendChild(button);
    
    callback = callback || text;
    callback.button = button;
    
    this.actions[name] = callback;
};

/**
 * Trigger the mod action
 * 
 * @param {String} name
 */
Mod.prototype.trigger = function (name, node) {
    if (!this.actions[name]) {
        return;
    }
    
    this.actions[name](node);
};

module.exports = Mod;