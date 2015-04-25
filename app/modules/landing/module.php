<?php

/**
 * Landing page module
 * 
 * @author volter9
 */

/**
 * Landing module amin initialize
 */
function landing_module_admin_init () {
    menu_add_item('landing', 'Лэндинг', url('#admin_landing'));
}