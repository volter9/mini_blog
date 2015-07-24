/**
 * mini_blog.js
 * 
 * JS library for inline edit and other stuff for mini_blog
 * 
 * Probably looks like one of those JS frameworks, but it's
 * not. It's more like a set of utilities.
 * 
 * @author volter9
 * @package mini_blog
 */

var utils = require('./helpers/utils');

var mini_blog = {
    components: require('./core/components'),
    component:  require('./core/component'),
    settings:   require('./core/settings'),
    panel:      require('./core/panel'),
    init:       require('./core/init'),
    mod:        require('./core/mod'),
    events:     require('./helpers/events'),
    ajax:       require('./helpers/ajax'),
    dom:        require('./helpers/dom'),
    mvc:        require('./mvc')
};

utils.extend(mini_blog, utils);

global.mini_blog = mini_blog;