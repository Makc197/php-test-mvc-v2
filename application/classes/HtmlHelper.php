<?php

class HtmlHelper
{
    static function createSelect(array $params, array $data, $selected = null)
    {
        $html = '<select ';
        foreach ($params as $k => $val)
        {
            $html.= $k.'="'.$val.'"';
        }
        $html.='>';
        foreach($data as $val => $option)
        {
            $selected_attr = ($selected && $val==$selected) ? 'selected' : '';
            $html.= '<option '.$selected_attr.' value="'.$val.'">'.$option.'</option>';
        }
        $html .= '</select>';

        return $html;
    }
}