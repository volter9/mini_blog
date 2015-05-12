<?php

/**
 * Get all landing sections
 * 
 * @return array
 */
function landing_sections () {
    return db_select('
        SELECT 
            l_s.id, l_s.title, l_s.url, l_s.content, l_s.show_in_menu,
            l_t.html
        FROM landing_sections l_s
            LEFT JOIN landing_templates l_t
            ON (l_s.template = l_t.id)
        ORDER BY l_s.id
    ');
}

/**
 * View landing section
 * 
 * @param array $section
 * @return string
 */
function landing_view_section ($section) {
    $data = json_decode($section['content'], true); 
    $data = array_merge(array('title' => $section['title']), $data);
    
    $html = $section['html'];
    
    foreach ($data as $key => $value) {
        $html = str_replace('{' . $key . '}', $value, $html);
    }
    
    return $html;
}