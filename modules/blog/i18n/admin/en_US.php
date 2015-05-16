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
    )
);