/**
 * Settings container
 */
var Settings = {
    settings: {},
    
    /**
     * @param {String} key
     * @return {Object}
     */
    get: function (key) {
        if (this.settings[key]) {
            return this.settings[key];
        }
        
        return null;
    },
    
    /**
     * @param {String} key
     * @param {Object} value
     * @return {Object}
     */
    set: function (key, value) {
        this.settings[key] = value;
    },
    
    /**
     * Replace the settings with new settings
     * 
     * @param {Object} settings
     */
    assign: function (settings) {
        this.settings = settings;
    }
};

module.exports = Settings;