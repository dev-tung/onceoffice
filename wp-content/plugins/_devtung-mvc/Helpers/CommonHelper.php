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