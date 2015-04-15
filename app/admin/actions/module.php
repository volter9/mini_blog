<?php

/**
 * Load all components and check for existent module
 */
function actions_init () {
    $module = router('route.matches.0');
    
    if (!admin_module_exists($module)) {
        return false;
    }
    
    load_component('database');
    
    if (is_post()) {
        load_api('validation');
    }
}

/**
 * View (browse) module with pagination
 * 
 * @param string $module
 * @param int $page
 */
function action_view ($module, $page = 1) {
    load_api('pagination');
    
    $description = admin_describe_module($module);
    $fields = "id, {$description['fields']}";
    
    $items = db_browse(
        $module, $fields, 
        $description['per_page'], 
        $page
    );
    
    $title = lang("admin.$module.title");
    
    view('main', array(
        'view'   => 'basic/view',
        'title'  => $title,
        'header' => $title,
        'module' => $module,
        'data'   => $items['items'],
        'pages'  => $items['pages'],
        'template' => isset($description['template'])
            ? $description['template']
            : 'basic/views/table'
    ));
}

/**
 * Show the form which allows to add a row
 * 
 * @param string $module
 * @param array $data
 */
function action_add ($module, array $data = array(), array $errors = array()) {
    $url = url('#admin_add_post', array($module));
    
    view_modify_page($module, 'add', $url, $data, $errors);
}

/**
 * Add a row into the module's table 
 * In case of failure show form with filled data
 * 
 * @param string $module
 */
function action_add_post ($module) {
    $input = input();
    $data = admin_filter_input($module, $input);
    
    if (validate_module($module, $input) && db_insert($module, $data)) {
        redirect('#admin_view', array($module));
    }
    
    action_add($module, $input, validation_errors());
}

/**
 * Show the edit form
 * 
 * @param string $module
 * @param int $id
 * @param array $data
 */
function action_edit ($module, $id, array $data = array(), array $errors = array()) { 
    $data = $data ? $data : db_find($module, $id);
    
    $url = url('#admin_edit_post', array($module, $id));
    
    view_modify_page($module, 'edit', $url, $data, $errors);
}

/**
 * Edit a row 
 * In case of failure show form with filled data
 * 
 * @param string $module
 */
function action_edit_post ($module, $id) {
    $item  = db_find($module, $id);
    $input = input();
    
    $keys  = extract_keys($item, $input);
    $data  = limit_keys(admin_filter_input($module, $input), $keys);
    $input = limit_keys($input, $keys);
    
    $original_input['id'] = $input['id'] = $id;
    
    if (
        empty($keys) ||
        validate_module($module, $input) && 
        db_update($module, $data, array('id[=]' => $id))
    ) {
        redirect('#admin_view', array($module));
    }
    
    action_edit($module, $id, array_merge($item, $input), validation_errors());
}

/**
 * Get matched keys and values from $item
 * to $input
 * 
 * @param array $item
 * @param array $input
 * @return array
 */
function extract_keys (array $item, array $input) {
    $keys = array();
    
    foreach ($input as $key => $value) {
        if (isset($item[$key]) && (string)$item[$key] !== $value) {
            $keys[] = $key;
        }
    }
    
    return $keys;
}

/**
 * Leave only provided keys in input array
 * 
 * @param array $array
 * @param array $keys
 * @return array
 */
function limit_keys (array $array, array $keys) {
    if (empty($keys)) {
        return $array;
    }
    
    foreach ($array as $key => $value) {
        if (!in_array($key, $keys)) {
            unset($array[$key]);
        }
    }
    
    return $array;
}

/**
 * Validate input
 * 
 * @param string $module
 * @param array $input
 */
function validate_module ($module, array $input) {
    $rules = admin_module_rules($module);
    
    validation_init(lang("admin.$module.fields"), i18n('messages'));
    
    return validate($input, limit_keys($rules, array_keys($input)));
}

/**
 * Template for displaying module modify page
 * 
 * @param string $module
 * @param string $action
 * @param string $url
 * @param array $data
 * @param array $errors
 */
function view_modify_page ($module, $action, $url, array $data, array $errors) {
    load_api('forms');
    forms('providers', load_app_file('admin/providers'));
    
    $title = lang("admin.$module.$action");
    $description = admin_describe_module($module);
    
    view('main', array(
        'title'  => $title,
        'header' => $title,
        'view'   => 'basic/modify',
        'module' => $module,
        'edit'   => $action === 'edit',
        'scheme' => array(
            'view'   => 'forms/admin',
            'submit' => lang("admin.admin.$action"),
            'action' => $url,
            'form'   => $description['form']
        ),
        'data' => array(
            'errors' => $errors,
            'input'  => $data,
            'field'   => lang("admin.$module.fields"),
            'tooltip' => lang("admin.$module.tooltips")
        )
    ));
}

/**
 * Show the remove form
 * 
 * @param string $module
 * @param int $id
 */
function action_remove ($module, $id) {
    db_remove($module, $id);
    
    redirect('#admin_view', array($module));
}