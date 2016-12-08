<?php

namespace classes;

use classes\exceptions\ViewGridException;
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

        if (count($filteritems) !== count($items)) {
            throw new ViewGridException(sprintf('All objects in list must be instance of class <<%s>> !', $className));
        }
    }

    //создается разметка html
    protected static function getMarkup($fields, $items, $config) {

        $labels = $items[0]->getAttributeLabels();

        $html = '<table class = "table" >';

        //Последний столбец для actions - добавляем в массив
        if (isset($config['actions'])) {
            $actionsLabel = isset($config['actionsLabel']) ? $config['actionsLabel'] : 'Actions';
            $newlabelsarr['actionsLabel'] = $actionsLabel;
            $headerlabels = array_merge($labels, $newlabelsarr);
        }

        //var_dump($labels);
        //var_dump($fields);
        //var_dump($items);
        //var_dump($config);
        //die();
        //
        //Рисуем шапку таблицы используя HtmlHelper::createTableHeader
        $html .= \classes\HtmlHelper::createTableHeader($headerlabels);
        
        //Рисуем строки таблицы - по одной строке для каждого объекта
        foreach ($items as $modelobject) {
            //$actions = \classes\HtmlHelper::createActions($modelobject, $config); //Перенести в HtmlHelper
            $html .= \classes\HtmlHelper::createTableRow2($modelobject, $labels, $config);
        }

        $html .= '</table>';

        return $html;
    }

}
