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
    add: require('./add')
};

utils.extend(panel, require('./mods'));

module.exports = panel;