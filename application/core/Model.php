<?php
namespace core;

use classes\DataBase;
use classes\exceptions\InvalidMethodException;

abstract class Model {

    public function __get($param) {
        $methodName = 'get'.ucfirst($param);        
        if(!method_exists($this, $methodName)){
            throw new InvalidMethodException(
                    sprintf(InvalidMethodException::MESSAGE, $methodName, get_class($this)));
        }
        return $this->$methodName();
    }
    
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
