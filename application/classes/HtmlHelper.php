<?php

namespace classes;

class HtmlHelper {

    static function createTableHeader(array $data) {
        $html = '<thead><tr>';
        foreach ($data as $val) {
            $html .= '<th>' . $val . '</th>';
        }
        $html .= '</tr></thead>';

        return $html;
    }

    static function createTableRow(array $data, $controller) {

        $id = $data['Id'];

        $html = '<tr class="' . $controller . '" data-id="' . $id . '">';
        foreach ($data as $val) {
            $html .= '<td>' . $val . '</td></tr>';
        }

        return $html;
    }

    static function createTableRowWithActions(array $data, $controller) {

        $id = $data['Id'];

        $html = '<tr class="' . $controller . '" data-id="' . $id . '">';
        foreach ($data as $val) {
            $html .= '<td>' . $val . '</td>';
        }

        $UrlView = UrlManager::createUrl('/' . $controller . '/view', ['id' => $id]);
        $UrlUpdate = UrlManager::createUrl('/' . $controller . '/update', ['id' => $id]);
        $UrlDelete = UrlManager::createUrl('/' . $controller . '/delete', ['id' => $id]);

        $html .= '<td><a href="' . $UrlView . '"><span class="glyphicon glyphicon-search"></span></a>';
        $html .= '<a href="' . $UrlUpdate . '"><span class="glyphicon glyphicon-pencil"></span></a>';
        $html .= '<a href="' . $UrlDelete . '"><span class="glyphicon glyphicon-trash"></span></a></td></tr>';

        return $html;
    }

    static function createTableRow2($modelobject, $labels, $config) {
        $actarr = [];
        //Имя класса - пример: 'models\ModelCd'
        $className = get_class($modelobject);
        //Вычисляем тип объекта - пример: 'Cd'
        $objtype = lcfirst(mb_substr($className, 12));
        //Вычисляем id - всегда через геттер getId()
        $id = $modelobject->getId();

        $items = array_keys($labels);

        $html = '<tr class="' . $objtype . '" data-id="' . $id . '">';
        foreach ($items as $item) {
            $html .= sprintf('<td>%s</td>', $modelobject->$item);
        }

        //Если нужен столбец Action - отрисовываем 
        if (isset($config['actions'])) {
            $html .= '<td>';
            $actarr = self::createActions($modelobject, $objtype, $config);
            //отрисовка необходимых Actions
            foreach ($actarr as $actName => $lambda) {
                $html .= $lambda($modelobject, $objtype); //Вызов анонимной функции $lambda - передали из View в $config['actions'] 
            }
            $html .= '</td>';
        }

        $html .= '</tr>';
        
        return $html;
    }

    static function createActions($modelobject, $objtype, $config) {
        //var_dump($objtype); die;
        //Если есть массив $config['actions'] - в нем перечислены доступные варианты действий
        //Формируем массив анонимных функций которые потом вызовем на контенте объекта   
        $actarr = [];
        if (!isset($config['actions'])) {
            return '';
        }

        foreach ($config['actions'] as $value) {
            switch ($value) {

                case 'view':
                    $actarr['view'] = function ($model, $objtype) {
                        return '<a href="' . \classes\UrlManager::createUrl('/' . $objtype . '/view', ['id' => $model->getId()]) . '"><span class="glyphicon glyphicon-search"></span></a>';
                    };
                    break;

                case 'update':
                    $actarr['update'] = function ($model, $objtype) {
                        return '<a href="' . \classes\UrlManager::createUrl('/' . $objtype . '/update', ['id' => $model->getId()]) . '"><span class="glyphicon glyphicon-pencil"></span></a>';
                    };
                    break;

                case 'delete':
                    $actarr['delete'] = function ($model, $objtype) {
                        return '<a href="' . \classes\UrlManager::createUrl('/' . $objtype . '/delete', ['id' => $model->getId()]) . '"><span class="glyphicon glyphicon-trash"></span></a>';
                    };
                    break;
            }
        }

        return $actarr;
        //отрисовка необходимых Actions
        //foreach ($actarr as $actName => $lambda) {
        //    var_dump($lambda($modelobject, $objtype)); //Вызов анонимной функции $lambda - передали из View в $config['actions'] 
        //}
    }

    static function createSelect(array $params, array $data, $selected = null) {
        $html = '<select ';
        foreach ($params as $k => $val) {
            $html .= $k . ' = "' . $val . '"';
        }
        $html .= '>';
        foreach ($data as $val => $option) {
            $selected_attr = ($selected && $val == $selected) ? 'selected' : '';
            $html .= '<option ' . $selected_attr . ' value = "' . $val . '">' . $option . '</option>';
        }
        $html .= '</select>';

        return $html;
    }

}
