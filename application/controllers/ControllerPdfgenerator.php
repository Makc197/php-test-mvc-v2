<?php

namespace controllers;

use core\Controller;
use models\ModelXfdf;

class ControllerPdfgenerator extends Controller {

    public $data = [];
    public $errors = [];

    function getAccess($action) {
    // $access = isset($_SESSION['user']);
    // return $access && parent::getAccess($action);
    // 
    //По дефолту разрешим всем видеть
    //return true;

        $errors = $this->errors;
        $access = isset($_SESSION['user']);
        // return $access  && parent::getAccess($action);
        if ($access && parent::getAccess($action)) {
            return true;
        } else {
            $errors[] = 'Необходимо авторизоваться';
            return ['errors' => $errors];
        }
    }

    function action_reset() {
        header('Location: /pdfgenerator/index');
    }

    public function action_viewform() {
        $errors = $this->errors;
        $data = $this->data;
        //Рендерим вьюху - html форма в view/'pdf_forms/'.$_GET['formpath'].'.php'
        $this->view->generate('pdf_forms/'.$_GET['formpath'].'.php', 'template_view.php', ['data' => $data, 'errors' => $errors]);
    }
    
    public function action_index() {
        $errors = $this->errors;
        $data = $this->data;
        //Рендерим menu
        $this->view->generate('pdf_forms/menu.php', 'template_view.php', ['data' => $data, 'errors' => $errors]);
    }

    public function action_createpdf() {
        //Мапинг полей в модели '\models\pdf_forms\Model' . $_GET['formname'];
        $model_name = '\models\pdf_forms\Model' . $_GET['formname'];
        $model = new $model_name();
        $model->maping($_POST);
        echo '<a type="button" class="btn btn-primary btn-large" href="' . $model->url . '" target="_blank" >Печать заявления</a>';
    }

}
