<?php 

return [
    'main' => 'Main page',
    
    'header' => [
        'title' => 'mini_blog',
        'home'  => 'Home',
        'admin' => 'Admin'
    ],
    
    'footer' => [
        'all_rights' => 'All right reserved'
    ],
    
    'posts' => [
        'empty' => 'No posts',
        'published' => 'Published',
        'by' => 'by',
        'at' => 'at'
    ],
    
    'messages' => [
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
        
        /**
         * Complex messages
         */
        'compare' => function ($field, $to) {
            $to = validation("fields.$to") ?: $to;
            
            return sprintf('Field "%s" should be same as field "%s"', $field, $to);
        }
    ],
];