<?php

class Point {

    public $x;
    public $y;
    public static $points = [];

    //конструктор класса - инициализируем координаты +
    //вызов функции -добавление точки в массив + счетчик созданных точек
    public function __construct($x, $y) {
        $this->x = (int) $x;
        $this->y = (int) $y;
        self::addPoint($this);
    }

    //добавляем очередную точку в масив точек
    private function addPoint(self $point) {
        self::$points[] = $point;
    }

    public static function count() {
        return count(self::$points);
    }

    //функция возвращает массив точек
    public static function allPoints() {
        return self::$points;
    }
    
    public function __toString() {
        return "x=".$this->x.", y=".$this->y;
    }

}
