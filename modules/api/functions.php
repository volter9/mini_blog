<?php

/**
 * Alias for json_encode
 */
function json (array $data) {
    return json_encode($data, JSON_UNESCAPED_UNICODE);
}