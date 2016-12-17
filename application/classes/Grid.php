<?php

namespace classes;

use classes\exceptions\ViewGridException;
use core\ViewGridInterface;

class Grid {

    //$fields - массив полей, которые надо отобразить в представлении
    //$data - массив объектов Product($data в View)
    //$config - онфигурация для GRID

    public static function widget($fields, $data, $config = []) {
        self::filter($data);
        return self::getMarkup($fields, $data, $config);
    }

    //Проверка данных
    protected static function filter($data) {

        $className = get_class($data[0]);

        //класс должен использовать интерфейс
        if (!$data[0] instanceof ViewGridInterface) {
            throw new ViewGridException(sprintf('Class <<%s>> must implements ViewGridInterface !', $className));
        }

        //Все объекты одного класса
        $filteritems = array_filter($data, function($item) use ($className) {
            return ($item instanceof $className);
        });

        if (count($filteritems) !== count($data)) {
            throw new ViewGridException(sprintf('All objects in list must be instance of class <<%s>> !', $className));
        }
    }

    //создается разметка html
    protected static function getMarkup($fields, $data, $config) {
        //массив labels содержит все свойства из модели и их наименования as key=>val
        $labels = $data[0]->getAttributeLabels();
        $fieldslabels = [];

        //var_dump($labels);
        //var_dump($fields);
        //var_dump($data);
        //var_dump($config);
        //
        //
        //Пересчитаем массив labels(где все эл-ты) в соотв с массивом fields(где необх для отображ эл-ты)
        //оcтавим только необходимые для отображения элементы 
        //Использ in_array, т.к. вариант с array_intersect_key($labels, $fields) не работает, 
        //т.к. ключи разные - в одном случае массив ассоциативный, а в другом индексированный 
        //здесь ключ одного массива мы сравниваем с значениями другого
        foreach ($labels as $key => $value) {
            if (in_array($key, $fields)) {
                $fieldslabels[$key] = $value;
            }
        }

        $html = '<table class = "table" >';

        //Последний столбец в шапке таблицы для actions - добавляем в массив $headerlabels
        if (isset($config['actions'])) {
            $actionsLabel = isset($config['actionsLabel']) ? $config['actionsLabel'] : 'Actions';
            $newlabelsarr['actionsLabel'] = $actionsLabel;
            $headerlabels = array_merge($fieldslabels, $newlabelsarr);
        }

        //Рисуем шапку таблицы используя HtmlHelper::createTableHeader
        $html .= \classes\HtmlHelper::createTableHeader($headerlabels);

        //Рисуем строки таблицы - по одной строке для каждого объекта
        foreach ($data as $modelobject) {
            //$actions = \classes\HtmlHelper::createActions($modelobject, $config); //Перенести в HtmlHelper
            $html .= \classes\HtmlHelper::createTableRow2($modelobject, $fieldslabels, $config);
        }

        $html .= '</table>';

        return $html;
    }

}
