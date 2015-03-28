<?php

/**
 * Admin load component
 * 
 * @param string $component
 */
function load_component ($component) {
    load_app_file("admin/components/$component");
}