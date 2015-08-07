var utils = require('../../helpers/utils');

/**
 * Setup editor's container for buttons
 */
function setupContainer () {
    this.container = document.querySelector('#mini_panel .buttons');
};

/**
 * Add a mod to the editor
 * 
 * @param {mini_blog.editor.mod} mod
 */
function addMod (name, mod) {
    this.mods[name] = mod;
};

/**
 * Disable all mods
 */
function disableMods () {
    utils.each(this.mods, function (mod) { 
        mod.disable();
    });
};

/**
 * Enable given mods
 */
function enableMods (names) {
    utils.each(this.mods, function (mod) { 
        if (names.indexOf(mod.name) !== -1) {
            mod.enable();
        }
    });
};

var object = {
    mods: {},
    container: document.querySelector('#mini_panel .buttons'),
    
    disableMods: disableMods,
    enableMods:  enableMods,
    addMod:      addMod
};

module.exports = object;