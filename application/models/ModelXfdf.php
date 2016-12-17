<?php

namespace models;

class ModelXfdf {

    public $java = "java";
    public $jar = SITE_PATH . "/resources/xfdffill.jar";
    public $origin = "";
    public $temp = SITE_PATH . '/../files/';
    public $url = '/files/';
    public $resultxfdf_data = "";
    public $resultpdf = "";
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
        $this->resultpdf = $this->temp . $name . ".pdf";
        $this->resultxfdf_data = $this->temp . $name . ".xfdf";
        $header = '<?xml version="1.0" encoding="UTF-8"?><xfdf xmlns="http://ns.adobe.com/xfdf/" xml:space="preserve"><f href="' . $this->resultpdf . '"/><fields>';
        $footer = '</fields></xfdf>';

        $body = $this->genFieldName($this->data);

        $xfdf_data = $header . $body . $footer;

        //$chrarr = array(chr ( 10 ), chr ( 13 ), chr ( 9 ));
        //$xfdf_data = str_ireplace ( $chrarr , '' , $xfdf_data);

        file_put_contents($this->resultxfdf_data, $xfdf_data);
        $exec = sprintf(
                '%s -jar "%s" "%s" "%s" "%s"', $this->java, $this->jar, $this->resultpdf, $this->origin, $this->resultxfdf_data
        );
        exec($exec);

        echo $exec;
        die;

        //unlink($this->resultxfdf_data);
        /*
          if (file_exists($this->resultpdf)) {
          if (ob_get_level()) {
          ob_end_clean();
          }
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename=' . basename($this->resultpdf));
          header('Content-Transfer-Encoding: binary');
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($this->resultpdf));
          readfile($this->resultpdf);
          }

          unlink($this->resultpdf);
         * 
         */
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
