<?php

/**
 * Blog routes.
 * Here are routes to:
 * 
 * Index page
 * Blog posts
 * Blog categories
 */
 
route('GET #index /', 'app/actions/index');
route('GET #posts /blog/all/:num?', 'app/actions/blog:list');
route('GET #post /blog/:any', 'app/actions/blog:view');
route('GET #category /categories/:any/:num?', 'app/actions/categories:view');