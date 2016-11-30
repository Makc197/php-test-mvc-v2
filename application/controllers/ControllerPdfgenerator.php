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

    public function action_index() {
        $errors = $this->errors;
        $data = $this->data;
        //Рендерим вьюху
        $this->view->generate('pdf_forms/click.php', 'template_view.php', ['data' => $data, 'errors' => $errors]);
    }

    public function action_createpdf() {

        //var_dump( $_POST);die;

        $xfdf = new ModelXfdf(SITE_PATH . "/resources/pdf_forms/click/uc_blank_click.pdf");

        //валюта счета
        $xfdf->setValue('1000', $_POST ['currency_account']);

        //фамилия
        $xfdf->setValue('1010-1', $_POST ['lastname']);

        //Имя
        $xfdf->setValue('1010-2', $_POST ['firstname']);

        //Отчество
        $xfdf->setValue('1010-3', $_POST ['middlename']);

        //серия
        $xfdf->setValue('1020-1', $_POST ['passportser']);

        //Номер
        $xfdf->setValue('1020-2', $_POST ['passportnum']);

        //Другая валюта
        $xfdf->setValue('1005', isset($_POST ['currency']) ?: null );

        //Кодовое слово
        $xfdf->setValue('1030', $_POST ['codeword']);

        //Наличие других счетов в АО ЮниКредит Банк
        $xfdf->setValue('2000', $_POST ['otheraccounts']);

        //персональный клиентский номер
        $xfdf->setValue('1040', $_POST ['clientnumber']);

        $xfdf->setValue('1050', $_POST ['ischanged']);

        //дата
        $xfdf->setValue('d-2.1', date("d"));

        $xfdf->setValue('d-2.2', date("m"));

        $xfdf->setValue('d-3.3', date("Y"));

        //дата
        $xfdf->setValue('d-1.1', date("d"));

        $xfdf->setValue('d-1.2', date("m"));

        $xfdf->setValue('d-1.3', date("Y"));

        $xfdf->genirationXFDF();

        echo '<a type="button" class="btn btn-primary btn-large" href="' . $xfdf->url . '" target="_blank" >Печать заявления</a>';
    }

}
