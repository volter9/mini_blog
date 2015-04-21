<?php

/**
 * Validation validators
 * 
 * @package mini_blog
 */

return array(
    /**
     * Require the field to be filled
     */
    'required' => function ($value) {
        return !!$value;
    },
    
    /**
     * Limit maximum length of input string
     */
    'max_length' => function ($value, $array, $length) {
        return mb_strlen($value) <= $length;
    },
    
    /**
     * Limit minimum length of input string
     */
    'min_length' => function ($value, $array, $length) {
        return mb_strlen($value) >= $length;
    },
    
    /**
     * Compare if two fields equivalent
     */
    'compare' => function ($value, $array, $to) {
        return isset($array[$to]) && $value === $array[$to];
    },
    
    /**
     * Unique values in database
     * 
     * Works only if database connected and table has `id` column and 
     * field provided column
     * 
     * Valid if there's no such row in database
     * or input array (i.e. form) has 'id' key and 
     * row's id matches with array's key 'id'
     */
    'unique' => function ($value, $array, $field) {
        list($table, $column) = explode('.', $field);
    
        $query = 'SELECT id, %1$s FROM %2$s WHERE %1$s = ?';
        $query = sprintf($query, $column, $table);
        
        $result = db_select($query, array($value), true);
        
        return !$result || 
        (
            isset($array['id'], $result['id']) && 
            (int)$array['id'] === (int)$result['id']
        );
    },
    
    /**
     * Valid if is a valid email adress
     */
    'valid_mail' => function ($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    },
    
    /**
     * Valid if field's value is alpha-dash 
     * (latin characters, numbers, unserscore and hyphen)
     */
    'alpha_dash' => function ($value) {
        return preg_match('/^[\w\d\-\_]+$/i', $value);
    },
    
    /**
     * Valid if field's value is numeric
     */
    'is_numeric' => function ($value) {
        return is_numeric($value);
    },
    
    /**
     * Basic HTML validation
     * 
     * Valid if has:
     * - no style or on* attributes (i.e. JS and CSS disallowed)
     * - "safe" html tags for text formatting
     */
    'html' => function ($value) {
        $stripped = strip_tags($value, '<a><b><strong><blockquote><i><em><br><br/><hr><hr/><ul><ol><li><h1><h2><h3><h4><h5><h6><img><img/><iframe><del><s><u>');
        
        return strlen($stripped) === strlen($value)
            && !preg_match('/<\w+[^\>]+(on\w+\s*=|style\s*=)[^\>]+>/', $value);
    },
    
    /**
     * Valid if contains no HTML at all
     */
    'no_html' => function ($value) {
        return strlen(strip_tags($value)) === strlen($value);
    }
);