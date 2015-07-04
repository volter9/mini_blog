<?php 

return array(
    'main' => 'Main page',
    
    'header' => array(
        'title' => 'mini_blog',
        'home'  => 'Home',
        'admin' => 'Admin',
        'latests' => 'Latests blog posts'
    ),
    
    'footer' => array(
        'all_rights' => 'All right reserved'
    ),
    
    'posts' => array(
        'empty' => 'No posts',
        'published' => 'Published',
        'in_category' => 'in category',
        'by' => 'by',
        'at' => 'at'
    ),
    
    'messages' => array(
        /**
         * Regular plain text messages
         */
        'required'   => 'Field "%s" is required!',
        'min_length' => 'Field "%s" should be more than or equals to %s characters!',
        'max_length' => 'Field "%s" should be less than or equals to %s characters!',
        'unique'     => 'Value of field "%s" is already exists!',
        'valid_mail' => 'Field "%s" should be a valid email!',
        'alpha_dash' => 'Field "%s" should only contain letters, digits, dash and underscore!',
        'html'       => 'Field "%s" should only contain safe HTML tags!',
        'no_html'    => 'Field "%s" should not contain any HTML tags!',
        
        /**
         * Complex messages
         */
        'compare' => function ($field, $to) {
            $field_to = validation("fields.$to");
            
            $to = $field_to ? $field_to : $to;
            
            return sprintf('Field "%s" should be same as field "%s"', $field, $to);
        },
        
        'no_user' => 'User does not exists or password does not matches'
    ),
);