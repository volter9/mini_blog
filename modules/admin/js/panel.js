/**
 * Admin panel
 */
mini_blog.panel = (function () {
    /**
     * @param {Node} node
     */
    function Panel (node) {
        this.node = node; 
    }
    
    return new Panel(document.getElementById('mini_panel'));
})();

/**
 * Status bar in admin panel
 */
mini_blog.panel.status = (function () {
    return {
        
    };
})();