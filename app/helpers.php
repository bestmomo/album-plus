<?php

if (!function_exists ('currentRoute')) {
    function currentRoute(...$routes)
    {
        foreach ($routes as $route) {
            if (request ()->url () == $route) {
                return ' active';
            }
        }
    }
}

if (!function_exists ('currentUrl')) {
    function currentUrl($url)
    {
        if (request ()->url () == url($url)) {
            return ' active';
        }
    }
}


