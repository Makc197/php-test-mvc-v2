<?php

namespace models;

class ModelXfdf {

    public $java = "java";
    public $jar = SITE_PATH . "/resources/xfdffill.jar";
    public $origin = "";
    public $temp = 'd:\OpenServer\userdata\temp\php-test-mvc-v2\\';
    public $url = '/files/';
    public $result_data = "";
    public $result = "";
    public $data;

    public function __construct($origin) {
        $this->origin = $origin;
    }

    public function setValue($field, $value) {
        $xml_path = explode(".", $field);
        $data_element = &$this->data;
        foreach ($xml_path as $key) {
            $data_element = &$data_element[$key];
        }
        $data_element["__value"] = $value;
    }

    public function genirationXFDF() {
        $name = microtime(true);
        $this->url .= $name . ".pdf";
        $this->result = $this->temp . $name . ".pdf";
        $this->result_data = $this->temp . $name . ".xfdf";
        $header = '<?xml version="1.0" encoding="UTF-8"?><xfdf xmlns="http://ns.adobe.com/xfdf/" xml:space="preserve"><f href="' . $this->result . '"/><fields>';
        $footer = '</fields></xfdf>';

        $body = $this->genFieldName($this->data);

        $xfdf_data = $header . $body . $footer;

        //$chrarr = array(chr ( 10 ), chr ( 13 ), chr ( 9 ));
        //$xfdf_data = str_ireplace ( $chrarr , '' , $xfdf_data);

        file_put_contents($this->result_data, $xfdf_data);
        $exec = sprintf(
                '%s -jar "%s" "%s" "%s" "%s"', $this->java, $this->jar, $this->result, $this->origin, $this->result_data
        );
        exec($exec);
        
        echo $exec;
        //unlink($this->result_data);
    }

    public function genFieldName($field) {
        $result = '';
        foreach ($field as $key => $value) {
            if ($key === "__value") {
                $result .= '<value>' . $value . '</value>';
            } elseif (is_array($value)) {
                $result .= '<field name="' . $key . '">';
                $result .= $this->genFieldName($value);
                $result .= '</field>';
            }
        }
        return $result;
    }

}
