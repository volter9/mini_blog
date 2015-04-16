<?php

/**
 * Load admin component
 * 
 * @param string $component
 */
function load_component ($component) {
    load_app_file("components/$component");
}