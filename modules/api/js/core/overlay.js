module.exports = {
    element: null,
    
    /**
     * Show overlay
     */
    show: function () {
        if (!this.element) {
            this.element = document.createElement('div');
            this.element.className = 'm-hidden m-overlay';
            
            document.body.appendChild(this.element);
        }
        
        this.element.classList.remove('m-hidden');
    },
    
    /**
     * Hide overlay
     */
    hide: function () {
        if (!this.element) {
            return;
        }
        
        this.element.classList.add('m-hidden');
    }
};