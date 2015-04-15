<?php

/**
 * Validation validators
 * 
 * @package mini_blog
 */

return array(
    'required' => function ($value) {
        return !!$value;
    },

    'max_length' => function ($value, $array, $length) {
        return mb_strlen($value) <= $length;
    },

    'min_length' => function ($value, $array, $length) {
        return mb_strlen($value) >= $length;
    },

    'compare' => function ($value, $array, $to) {
        return isset($array[$to]) && $value === $array[$to];
    },

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

    'valid_mail' => function ($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    },

    'alpha_dash' => function ($value) {
        return (bool)preg_match('/^[\w\d\-\_]+$/i', $value);
    },
    
    'is_numeric' => function ($value) {
        return is_numeric($value);
    },
    
    'html' => function ($value) {
        $stripped = strip_tags($value, '<a><b><strong><blockquote><i><em><br><br/><hr><hr/><ul><ol><li><h1><h2><h3><h4><h5><h6><img><img/><iframe><del><s><u>');
        
        return strlen($stripped) === strlen($value)
            && !preg_match('<\w+[^\>]+(on\w+\s*=|style\s*=)[^\>]+>', $value);
    },
    
    'no_html' => function ($value) {
        return strlen(strip_tags($value)) === strlen($value);
    }
);