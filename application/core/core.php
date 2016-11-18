<?php
session_start(); //старт сессии

use classes\DataBase;
use core\Route;

//Старая версия autoloader'а
//$autoloader=function ($classname) {
//    $classdir1 = DS . 'application' . DS . 'core';
//    $classdir2 = DS . 'application' . DS . 'classes';
//    $classdir3 = DS . 'application' . DS . 'models';
//    $classdirarr = array($classdir1, $classdir2, $classdir3 );
//    foreach ($classdirarr as $folder) {
//        $filename = $classname. '.php';
//        // путь до класса
//        $file = SITE_PATH . $folder . DS . $filename;
//        // подключаем файл с классом
//        if (file_exists($file)) {
//            include($file); 
//            return true;
//        } 
//    } 
//    return false;
//}; 
//Загрузка классов из application/core и application/classes
//spl_autoload_register($autoloader);
//$db = new \PDO('mysql:host=127.0.0.1;dbname=test;charset=utf8', 'root', '');

$dsn = 'mysql:host=localhost;dbname='.DB_NAME.';charset=utf8';
DataBase::init(array('dsn'=>$dsn,'user'=>DB_USER,'password'=>DB_PASS));

Route::start(); // запускаем маршрутизатор