<?php

/**
 * View browse page
 * 
 * @param string $module
 * @param int $page
 */
function view_browse_page ($module, $page) {
    $description = admin_describe_module($module);
    $fields = "id, {$description['fields']}";
    
    $items = db_browse($module, $fields, $description['per_page'], $page);
    $title = lang("admin.$module.title");
    
    layout('basic/view', array(
        'title'    => $title,
        'header'   => $title,
        'module'   => $module,
        'data'     => $items['items'],
        'pages'    => $items['pages'],
        'template' => array_get($description, 'template', 'basic/views/table')
    ));
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
    
    forms('providers', load_php(module_path('admin', 'providers')));
    
    $title = lang("admin.$module.$action");
    $description = admin_describe_module($module);
    
    layout('basic/modify', array(
        'title'  => $title,
        'header' => $title,
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