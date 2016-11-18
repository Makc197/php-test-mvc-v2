<?php
namespace classes;

//use namespaces:
//use name1\Database as data1;
//use name2\Database as data2;

class DataBase {

    static private $instance = null;

    // Защищаем от создания через new DataBase
    private function __construct() { /* ... @return Singleton */
    }

    // Защищаем от создания через клонирование
    private function __clone() { /* ... @return Singleton */
    }

    private function __sleep() { /* ... @return Singleton */
    }

    private function __wakeup() { /* ... @return Singleton */
    }

    static public function init($config) {
        if (self::$instance === null) {
            self::$instance = new \PDO($config['dsn'], $config['user'], $config['password']);
        }
    }

    static public function getInstance() {
        return self::$instance;
    }

}
