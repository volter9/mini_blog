<?php

return array(
    'blog' => array(
        'title' => 'Blog'
    ),
    
    'posts' => array(
        'title'  => 'Posts',
        'add'    => 'Add a post',
        'edit'   => 'Edit the post',
        'remove' => 'Remove the post',
        
        'fields' => array(
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
        'edit'   => 'Edit a category',
        'remove' => 'Remove a category'
    )
);