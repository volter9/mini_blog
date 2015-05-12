<?php

/**
 * Templates routes
 * 
 * Routes to:
 * - view all templates
 * - change current template
 */

$path = module_path('templates', 'actions');

route('GET #admin_templates_view /admin/templates', "$path/index");
route('GET #admin_templates_choose /admin/templates/choose/:any', "$path/index:choose");