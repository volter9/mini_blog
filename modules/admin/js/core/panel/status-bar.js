var node = document.querySelector('#mini_panel .status-bar');

var bar = {
    errors: [],
    node:   node, 
    icon:   node.querySelector('.fa'),
    
    /**
     * Show the success
     */
    success: function () {
        this.node.className = 'status-bar button success';
        this.icon.className = 'fa fa-fw fa-check-circle';
    },
    
    /**
     * Show the error 
     * 
     * @param {Array} errors
     */
    failure: function (errors) {
        this.node.className = 'status-bar button failure';
        this.icon.className = 'fa fa-fw fa-exclamation-circle';
        
        this.errors.concat(Array.isArray(errors) ? errors : [errors]);
    },
    
    /**
     * Restore back to original state
     */
    clear: function () {
        this.errors = [];
        
        this.node.className = 'status-bar button';
        this.icon.className = 'fa fa-fw fa-circle';
    },
    
    /**
     * Restore back to original state
     */
    wait: function () {
        this.errors = [];
        
        this.node.className = 'status-bar button';
        this.icon.className = 'fa fa-fw fa-spinner fa-spin';
    }
};

module.exports = bar;