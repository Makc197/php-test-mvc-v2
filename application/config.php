<?php
// Задаем константы:
define ('DS', DIRECTORY_SEPARATOR); // разделитель для путей к файлам
$sitePath = realpath($_SERVER['DOCUMENT_ROOT']. DS);
define ('SITE_PATH', $sitePath); // путь к корневой папке сайта
 
// Для подключения к бд
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'test-mvc-v2');