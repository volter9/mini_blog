var utils = require('../helpers/utils');

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

/**
 * Set current editing component
 * 
 * @param {Node} node
 */
function setCurrent (node) {
    if (this.active || !node.component) {
        return;
    }
    
    var mods = ['edit'].concat(node.component.currentMods || []);
    
    this.current = node;
    
    this.disableMods();
    this.enableMods(mods);
};

/**
 * Clear current editable target
 */
function clearCurrent () {
    if (!this.active) {
        return;
    }
    
    this.active = false;
    this.container.className = 'hidden';
};

var object = {
    current: null,
    active:  false,
    mods:    {},
    
    setupContainer: setupContainer,
    clearCurrent:   clearCurrent,
    disableMods:    disableMods,
    setCurrent:     setCurrent,
    enableMods:     enableMods,
    addMod:         addMod
};

object.setupContainer();

module.exports = object;