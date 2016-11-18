<?php
namespace core;

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
    
    protected static function pdoSet($allowed, &$values, $source = array()) {
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
