<?php

return array(
    /**
     * Get all priveleges
     * 
     * @return array
     */
    'privileges' => function () {
        $privileges = array();
        
        foreach (groups() as $key => $value) {
            $privileges[] = array(
                'title' => $value,
                'value' => $key
            );
        }
        
        return $privileges;
    }
);