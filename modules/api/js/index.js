/**
 * mini_blog.js
 * 
 * JS library/framework for inline edit and other stuff for mini_blog
 * 
 * Probably looks like one of those JS frameworks, but it's
 * not. It's more like a set of utilities with MVC components.
 * 
 * @author volter9
 * @package mini_blog
 */

var mini_blog = {
    components: require('./core/components/collection'),
    component:  require('./core/components/component'),
    settings:   require('./core/settings'),
    editor:     require('./core/editor'),
    fields:     require('./core/fields'),
    field:      require('./core/fields/field'),
    panel:      require('./core/panel'),
    init:       require('./core/init'),
    events:     require('./helpers/events'),
    unique:     require('./helpers/unique'),
    utils:      require('./helpers/utils'),
    ajax:       require('./helpers/ajax'),
    dom:        require('./helpers/dom'),
    mvc:        require('./mvc')
};

mini_blog.component.view = require('./core/components/view');

global.markdown = require('marked');

module.exports = mini_blog;