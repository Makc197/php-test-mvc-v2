<?php
/// включим отображение всех ошибок
error_reporting(E_ALL);
//ini_set('display_errors', 1);
// подключаем конфиг
include ('config.php');

// подключаем ядро сайта
include (SITE_PATH . DS . 'application' . DS . 'core' . DS . 'core.php');
?>