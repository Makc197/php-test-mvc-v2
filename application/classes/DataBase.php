<?php

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
            self::$instance = new PDO($config['dsn'], $config['user'], $config['password']);
        }
    }

    static public function getInstance() {
        return self::$instance;
    }

    static public function pdoSet($allowed, &$values, $source = array()) {
        $set = '';
        $values = array();
        if (!$source) {
            $source = &$_POST;
        }
        foreach ($allowed as $field) {
            if (isset($source[$field])) {
                $set.="`" . str_replace("`", "``", $field) . "`" . "=:$field, ";
                $values[$field] = $source[$field];
            }
        }
        return substr($set, 0, -2);
    }

}
