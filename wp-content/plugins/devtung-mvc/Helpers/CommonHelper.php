<?php
if (!function_exists('dump')) {
    function dump(...$vars) {
        echo '<pre>';
        foreach ($vars as $v) {
            var_dump($v);
        }
        echo '</pre>';
    }
}

if (!function_exists('dd')) {
    function dd(...$vars) {
        dump(...$vars);
        die(1);
    }
}


if (!function_exists('dt_get_url_segments')) {
    function dt_get_url_segments() {
        $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        return explode('/', $path);
    }
}