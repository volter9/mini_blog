var mvc  = require('../mvc'),
    mods = require('./panel/mods');

var editing = false;

/** HTML template */
var html = '<div class="edit">'
+ '    <!-- <button class="edit-button button">'
+ '        <i class="fa fa-fw fa-pencil"></i>'
+ '    </button> -->'
+ '</div>'
+ '<div class="editing">'
+ '    <button class="save-button button">'
+ '        <i class="fa fa-fw fa-floppy-o"></i>'
+ '    </button>'
+ '    <button class="cancel-button button">'
+ '        <i class="fa fa-fw fa-times"></i>'
+ '    </button>'
+ '    <button class="remove-button button">'
+ '        <i class="fa fa-fw fa-trash"></i>'
+ '    </button>'
+ '</div>';

/**
 * Editor view
 */
var view = mvc.view.extend({
    /**
     * Initialize 
     */
    initialize: function () {
        var self = this;
        
        this.node = document.createElement('div');
        this.node.className = 'm-editor';
        this.node.innerHTML = html;
        
        this.setupEvents();
        this.show(true);
    },
    
    /**
     * Setup events
     */
    setupEvents: function () {
        this.data.node.addEventListener('dblclick', this.edit.bind(this));
        
        this.bind('.save-button',   'click', this.save);
        this.bind('.cancel-button', 'click', this.cancel);
        this.bind('.remove-button', 'click', this.remove);
    },
    
    /**
     * Disable editing
     */
    disable: function () {
        this.data.component.disable();
        mods.disableMods();
        
        editing = false;
        
        this.show(true);
    },
    
    /**
     * Enable editing
     */
    edit: function () {
        if (editing) return;
        
        editing = true
        mods.enableMods(this.data.component.mods || []);
        
        this.data.component.enable();
        this.show(false);
    },
    
    /**
     * Remove the item from database
     */
    remove: function () {
        if (window.confirm('Are you sure you want to delete this entry?')) {
            this.disable();
            this.data.component.remove();
            this.destroy();
        }
    },
    
    /**
     * Save edited content
     */
    save: function () {
        this.disable();
        this.data.component.save();
    },
    
    /**
     * Cancel editing
     */
    cancel: function () {
        this.disable();
        this.data.component.cancel();
    },
    
    /**
     * Destroy the view
     */
    destroy: function () {
        this.node.parentNode.removeChild(this.node);
    },
    
    /**
     * Show/hide buttons
     */
    show: function (editing) {
        this.find('.edit').style.display    = editing ? 'block' : 'none';
        this.find('.editing').style.display = editing ? 'none' : 'block';
        
        if (this.data.component.notRemovable) {
            this.find('.remove-button').style.display = 'none';
        }
    }
});

module.exports = {view: view};