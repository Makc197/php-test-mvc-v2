<?php

namespace classes;

class HtmlHelper {

    static function createTableHeader(array $data) {
        $html = '<thead><tr>';
        foreach ($data as $val) {
            $html .= '<th>' . $val . '</th>';
        }
        $html .='</tr></thead>';

        return $html;
    }

    static function createTableRow(array $data, $controller) {

        $id = $data['Id'];

        $html = '<tr class="' . $controller . '" data-id="' . $id . '">';
        foreach ($data as $val) {
            $html .= '<td>' . $val . '</td>';
        }

        $UrlView = \classes\UrlManager::createUrl('/'.$controller.'/view', ['id' => $id]);
        $UrlUpdate = \classes\UrlManager::createUrl('/'.$controller.'/update', ['id' => $id]);
        $UrlDelete = \classes\UrlManager::createUrl('/'.$controller.'/delete', ['id' => $id]);

        $html .= '<td><a href="' . $UrlView . '"><span class="glyphicon glyphicon-search"></span></a>';
        $html .= '<a href="' . $UrlUpdate . '"><span class="glyphicon glyphicon-pencil"></span></a>';
        $html .= '<a href="' . $UrlDelete . '"><span class="glyphicon glyphicon-trash"></span></a></td></tr>';

        return $html;
    }

    static function createSelect(array $params, array $data, $selected = null) {
        $html = '<select ';
        foreach ($params as $k => $val) {
            $html.= $k . ' = "' . $val . '"';
        }
        $html.='>';
        foreach ($data as $val => $option) {
            $selected_attr = ($selected && $val == $selected) ? 'selected' : '';
            $html.= '<option ' . $selected_attr . ' value = "' . $val . '">' . $option . '</option>';
        }
        $html .= '</select>';

        return $html;
    }

}
