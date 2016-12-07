<?php

namespace classes;

use core\ViewGridException;
use core\ViewGridInterface;

class Grid {

    //$fields - массив полей, которые надо отобразить в представлении
    //$items - массив объектов Product($data в View)
    //$config - онфигурация для GRID

    public static function widget($fields, $items, $config = []) {
        self::filter($items);
        return self::getMarkup($fields, $items, $config);
    }

    //Проверка данных
    protected static function filter($items) {

        $className = get_class($items[0]);
        //класс должен использовать интерфейс
        if (!$items[0] instanceof ViewGridInterface) {
            throw new ViewGridException(sprintf('Class <<%s>> must implements ViewGridInterface !', $className));
        }

        //Все объекты одного класса
        $filteritems = array_filter($items, function($item) use ($className) {
            return ($item instanceof $className);
        });

        if (count($filteritems) !== count($items))
            throw new ViewGridException(sprintf('All objects in list must be instance of class <<%s>> !', $className));
    }

    //создается разметка html
    protected static function getMarkup($fields, $items, $config) {

        $labels = $items[0]->getAttributeLabels();

        $html = '<table class = "table" >';

        //Последний столбец для actions
        if (isset($config['actions'])) {
            $actionsLabel = isset($config['actionsLabel']) ? $config['actionsLabel'] : 'Actions';
            $labelsarr['actionsLabel'] = $actionsLabel;
            $labels = array_merge($labels, $labelsarr);
        }

        //var_dump($labels);
        //var_dump($fields);
        //var_dump($items);
        //var_dump($config);
        //die();
        //Рисуем шапку таблицы используя HtmlHelper::createTableHeader
        $html .= \classes\HtmlHelper::createTableHeader($labels);

        //Рисуем строки таблицы 
        foreach ($items as $item) {
            // \classes\HtmlHelper::createTableRow($items);
            $actions = self::createActions($item, $config); //Перенести в HtmlHelper
        }

        $html .= '</table>';

        return $html;
    }

    public function createActions($modelobject, $config) {
        //Перенести в HtmlHelper 
        foreach ($config['actions'] as $actName => $lambda) {
            $html.=$lambda($modelobject).'';//Вызов анонимной функции $lambda - передали из View в $config['actions'] 
        }
    }

}
