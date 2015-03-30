<?php

/**
 * Load all components and check for existent module
 */
function actions_init () {
    $module = router('route.matches.0');
    
    load_model($module);
    load_app_file('admin/components/loader');
    load_component('admin');
    
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
    $fields      = "id, {$description['fields']}";
    
    $items = db_browse(
        $module, $fields, 
        $description['per_page'], 
        $page
    );
    
    $title = lang("admin.$module.title");
    
    view('main', [
        'view'   => 'basic/view',
        'title'  => $title,
        'header' => $title,
        'module' => $module,
        'data'   => $items['items'],
        'pages'  => $items['pages']
    ]);
}

/**
 * Show the form which allows to add a row
 * 
 * @param string $module
 * @param array $data
 */
function action_add ($module, array $data = [], array $errors = []) {
    $url = url('#admin_add_post', [$module]);
    
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
    $data  = $input;
    
    // Temporary ugly hack
    if ($module === 'users') {
        $data['password'] = md5($data['password']);
    }
    
    if (validate_module($module, $input) && db_insert($module, $data)) {
        redirect('#admin_view', [$module]);
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
function action_edit ($module, $id, array $data = [], array $errors = []) { 
    $data = $data ?: db_find($module, $id);
    $url  = url('#admin_edit_post', [$module, $id]);
    
    view_modify_page($module, 'edit', $url, $data, $errors);
}

/**
 * Edit a row 
 * In case of failure show form with filled data
 * 
 * @param string $module
 */
function action_edit_post ($module, $id) {
    $input = input();
    $data  = $input;
    $data['id'] = $id;
    $criteria   = ['id[=]' => $id];
    
    // Temporary ugly hack
    if ($module === 'users') {
        $input['password'] = md5($input['password']);
    }
    
    if (validate_module($module, $data) && db_update($module, $input, $criteria)) {
        redirect('#admin_view', [$module]);
    }
    
    action_edit($module, $id, $data, validation_errors());
}

/**
 * Validate input
 * 
 * @param string $module
 * @param array $input
 */
function validate_module ($module, array $input) {
    validation_init(load_app_file('validators'), i18n('messages'));
    validation_rules(admin_module_rules($module));
    validation_fields(lang("admin.$module.fields"));
    
    return validate($input);
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
    
    $title       = lang("admin.$module.$action");
    $description = admin_describe_module($module);
    
    view('main', [
        'title'  => $title,
        'header' => $title,
        'view'   => 'basic/modify',
        'module' => $module,
        'edit'   => $action === 'edit',
        'scheme' => [
            'view'   => 'forms/admin',
            'submit' => lang("admin.admin.$action"),
            'action' => $url,
            'form'   => $description['form']
        ],
        'data' => [
            'errors' => $errors,
            'input'  => $data,
            'field'   => lang("admin.$module.fields"),
            'tooltip' => lang("admin.$module.tooltips")
        ]
    ]);
}

/**
 * Show the remove form
 * 
 * @param string $module
 * @param int $id
 */
function action_remove ($module, $id) {
    db_remove($module, $id);
    
    redirect('#admin_view', [$module]);
}