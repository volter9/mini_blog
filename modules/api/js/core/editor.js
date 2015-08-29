var mvc = require('../mvc');

/** HTML template */
var html = '<div class="edit">'
+ '    <a class="edit-button button">'
+ '        <i class="fa fa-fw fa-pencil"></i>'
+ '    </a>'
+ '    <a class="remove-button button">'
+ '        <i class="fa fa-fw fa-trash"></i>'
+ '    </a>'
+ '</div>'
+ '<div class="editing">'
+ '    <a class="save-button button">'
+ '        <i class="fa fa-fw fa-floppy-o"></i>'
+ '    </a>'
+ '</div>';

/**
 * Editor view
 */
var Editor = mvc.view.extend({
    /**
     * Initialize 
     */
    initialize: function () {
        var self = this;
        
        this.node = document.createElement('div');
        this.node.className = 'm-editor m-dynamic';
        this.node.innerHTML = html;
        
        this.setupEvents();
        this.show(true);
    },
    
    /**
     * Setup events
     */
    setupEvents: function () {
        this.data.node.addEventListener('dblclick', this.edit.bind(this));
        
        this.bind('.edit-button',   'click', this.edit);
        this.bind('.save-button',   'click', this.save);
        this.bind('.remove-button', 'click', this.remove);
    },
    
    /**
     * Disable editing
     */
    disable: function () {
        this.data.component.disable();
        
        Editor.editing = false;
        
        this.show(true);
    },
    
    /**
     * Enable editing
     */
    edit: function () {
        if (Editor.editing) return;
        
        Editor.editing = true
        
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
    },
    
    inline: function () {
        this.node.classList.remove('m-dynamic');
        
        this.find('.edit-button').innerHTML = 'Редактировать';
        this.find('.save-button').innerHTML = 'Сохранить';
        this.find('.remove-button').innerHTML = 'Удалить';
    }
});

Editor.editing = false;

module.exports = Editor;