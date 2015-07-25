var mvc   = require('../mvc'),
    panel = require('./panel');

var html = '<div class="edit">'
+ '    <button class="edit-button button">'
+ '        <i class="fa fa-fw fa-pencil"></i>'
+ '    </button>'
+ '    <button class="remove-button button">'
+ '        <i class="fa fa-fw fa-trash"></i>'
+ '    </button>'
+ '</div>'
+ '<div class="editing">'
+ '    <button class="save-button button">'
+ '        <i class="fa fa-fw fa-floppy-o"></i>'
+ '    </button>'
+ '    <button class="cancel-button button">'
+ '        <i class="fa fa-fw fa-times"></i>'
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