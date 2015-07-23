var utils = require('../helpers/utils');

/**
 * Setup editor's container for buttons
 */
function setupContainer () {
    var container = document.createElement('div');
    
    container.id = 'mini_editor';
    container.className = 'hidden';
    
    document.body.appendChild(container);
    
    this.container = container;
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
    
    this.move(node);
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

/**
 * Move container with editor buttons
 * 
 * @param {Node} node
 */
function move (node) {
    this.container.className = 'visible';
    
    var x = node.offsetLeft - this.container.offsetWidth - 10,
        y = node.offsetTop;
    
    this.container.style.left = x + 'px';
    this.container.style.top = y + 'px';
};

var object = {
    mods: {},
    current: null,
    active: false,
    
    setupContainer: setupContainer,
    disableMods:    disableMods,
    enableMods:     enableMods,
    addMod:         addMod,
    clearCurrent:   clearCurrent,
    setCurrent:     setCurrent,
    move:           move
};

object.setupContainer();

module.exports = object;