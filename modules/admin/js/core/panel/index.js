/**
 * mini_blog left side admin panel
 * 
 * Its responsibility is to display mods (buttons for editing),
 * status bar, and 
 * 
 * @package mini_blog
 */

var utils = require('../../helpers/utils');

var panel = {
    status: require('./status-bar'),
};

utils.extend(panel, require('./mods'));

module.exports = panel;