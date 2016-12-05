<?php

namespace classes;

class FProcess {

    private static $callbacks;

    //Регистрируем функции обратного вызова 
    //проверка вызываема ли функция и добавление функции в массив
    static function registerCallback($callback) {
        if (!is_callable($callback)) {
            throw new Exception("Функция обратного вызова невызываемая!");
        }
        self::$callbacks[] = $callback;
    }

    //Вызов функций обратного вызова из массива функций
    //Каждой функции передаем объект $product в качестве параметра
    static function callCbFunct(\models\ModelProduct $product) {
        print "{$product->getTitle()}: обрабатывается...... \n";
        foreach (self::$callbacks as $callback) {
            call_user_func($callback, $product);
        }
        die();
    }

}
