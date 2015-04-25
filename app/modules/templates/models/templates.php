<?php

/**
 * Get all templates
 * 
 * @return array
 */
function templates () {
    $templates = scandir(views('templates.directory'));
    
    return array_filter($templates, function ($v) {
        return strpos($v, '.')       === false
            && strpos($v, 'modules') === false;
    });
}

/**
 * Get content of template manifest
 * 
 * @throws \Exception
 * @param string $template
 * @return array
 */
function template_manifest ($template) {
    $manifest = sprintf('%s/%s/template.json', views('templates.directory'), $template);
    
    if (!file_exists($manifest)) {
        throw new Exception(
            "Template '$template' lacking of manifest.json! " .
            "Delete template, or add manifest.json."
        );
    }
    
    return json_decode(file_get_contents($manifest), true);
}