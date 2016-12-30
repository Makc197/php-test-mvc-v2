<?php

/// включим отображение всех ошибок
error_reporting(E_ALL);
//ini_set('display_errors', 1);
// подключаем конфиг
require_once 'application/config.php';
require_once 'application/core/autoloader.php';

// подключаем ядро сайта
require_once (SITE_PATH . DS . 'application' . DS . 'core' . DS . 'core.php');
?>