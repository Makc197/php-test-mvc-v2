<?php

namespace classes;

class UrlManager {

//echo \classes\UrlManager::createUrl('/cd/view', ['key1' => $val1, 'key2' => $val2, 'key3' => $val3]);

    public static function createUrl($route, $params) {
        //$route;
        //$params = [];
        $i=0;

        $url = $route . '?';
        foreach ($params as $key => $value) {
            if ($value !== null) {
                if ($i > 0) {
                    $url .= '&' . urlencode($key) . '=' . urlencode($value);
                } else {
                    $url .= urlencode($key) . '=' . urlencode($value);
                }
            }
            ++$i;
        }

        return $url;
    }

}
