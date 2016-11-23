<?php

spl_autoload_register(function ($classname) {
    $file = 'application\\' . $classname . '.php';

    if (is_file($file)) {
        include $file;
    }
});
