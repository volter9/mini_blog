var mvc   = require('../mvc'),
    panel = require('./panel');

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
        
        this.createButtonGroup('edit', [
            {name: 'edit-button',   title: '<i class="fa fa-fw fa-pencil"></i>'},
            {name: 'remove-button', title: '<i class="fa fa-fw fa-trash"></i>'}
        ]);
        
        this.createButtonGroup('editing', [
            {name: 'save-button',   title: '<i class="fa fa-fw fa-floppy-o"></i>'},
            {name: 'cancel-button', title: '<i class="fa fa-fw fa-times"></i>'}
        ]);
        
        this.setupEvents();
        this.show(true);
    },
    
    /**
     * Setup events
     */
    setupEvents: function () {
        var component = this.data.component,
            self      = this;
        
        this.find('.edit-button').addEventListener('click', function () {
            component.enable();
            
            panel.enableMods(component.mods || []);
            
            self.show(false);
        });
        
        this.find('.remove-button').addEventListener('click', function () {
            component.remove();
            
            self.destroy();
        });
        
        this.find('.save-button').addEventListener('click', function () {
            component.save();
            component.disable();
            panel.disableMods();
            
            self.show(true);
        });
        
        this.find('.cancel-button').addEventListener('click', function () {
            component.cancel();
            component.disable();
            panel.disableMods();
            
            self.show(true);
        });
    },
    
    /**
     * Create a button groups
     * 
     * @param {String} name
     * @param {Array} groups
     */
    createButtonGroup: function (name, groups) {
        var self    = this,
            buttons = document.createElement('div');
        
        buttons.className = name;
        
        groups.forEach(function (object) {
            var button = document.createElement('button');
            
            button.innerHTML = object.title;
            button.className = object.name + ' button';
            
            buttons.appendChild(button);
        });
        
        this.node.appendChild(buttons);
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