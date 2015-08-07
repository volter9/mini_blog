<?php

/**
 * mini_blog modules which should be loaded
 * 
 * api      - API module provides the front-end visual editor
 *            and REST API for editing content
 * users    - Users provides authorization of user
 * settings - REST and PHP API for working with settings in database
 * blog     - Blog module, posts and categories
 */

return array(
    'api',
    'users',
    'settings',
    'blog'
);