<?php

return array(
    'posts' => array(
        'title'  => 'Posts',
        'add'    => 'Add a post',
        'edit'   => 'Edit the post',
        'remove' => 'Remove the post',
        
        'fields' => array(
            'title'       => 'Title',
            'url'         => 'Post slug URL',
            'description' => 'Meta description',
            'text'        => 'Content',
            'user_id'     => 'Author',
            'category_id' => 'Category'
        ),
        
        'tooltips' => array(
            'title'       => 'Title of your post',
            'url'         => 'URL slug would be displayed in URL',
            'description' => 'Description of post, it is shown in category view and in meta tag information',
            'text'        => '<a href="http://daringfireball.net/projects/markdown/" target="_blank">Markdown</a> friendly content of your post, share you thoughts here',
            'user_id'     => 'Post\'s author',
            'category_id' => 'Post\'s category'
        )
    ),
    
    'categories' => array(
        'title'  => 'Categories',
        'add'    => 'Add a category',
        'edit'   => 'Edit the category',
        'remove' => 'Remove the category',
        
        'fields' => array(
            'title'       => 'Title',
            'url'         => 'Category slug URL',
            'description' => 'Meta description',
        ),
        
        'tooltips' => array(
            'title'       => 'Title of your category',
            'url'         => 'URL slug would be displayed in URL',
            'description' => 'Description of category, it is used in meta tags'
        ),
    ),
    
    'users' => array(
        'title'  => 'Users',
        'add'    => 'Add a user',
        'edit'   => 'Edit the user',
        'remove' => 'Remove the user',
        
        'fields' => array(
            'username' => 'Username',
            'password' => 'Password',
            'mail'     => 'Email',
            'group_id' => 'User Group'
        ),
        
        'tooltips' => array(
            'username' => 'User name (login)',
            'mail'     => 'User\'s e-mail',
            'group_id' => 'User\'s permission group'
        )
    )
);