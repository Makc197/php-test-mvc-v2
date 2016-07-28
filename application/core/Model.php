<?php

abstract class Model {

    protected static $db = null;

    protected static function getMySQLDb() {
        if (!static::$db) {
            static::$db = DataBase::getInstance();
        }

        return static::$db;
    }

    static function get_data() {
        
    }


}
