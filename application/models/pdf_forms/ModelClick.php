<?php

namespace models\pdf_forms;

use models\ModelXfdf;

class ModelClick extends ModelXfdf {

    public function __construct() {
        return parent::__construct(SITE_PATH . "/resources/pdf_forms/click/uc_blank_click.pdf");
    }

    public function maping($date) {

        //Мапинг HTML - PDF
        //Валюта счета
        $this->setValue('1000', $date ['currency_account']);

        //Фамилия
        $this->setValue('1010-1', $date ['lastname']);

        //Имя
        $this->setValue('1010-2', $date ['firstname']);

        //Отчество
        $this->setValue('1010-3', $date ['middlename']);

        //серия
        $this->setValue('1020-1', $date ['passportser']);

        //Номер
        $this->setValue('1020-2', $date ['passportnum']);

        //Другая валюта
        $this->setValue('1005', isset($date ['currency']) ?: null );

        //Кодовое слово
        $this->setValue('1030', $date ['codeword']);

        //Наличие других счетов в АО ЮниКредит Банк
        $this->setValue('2000', $date ['otheraccounts']);

        //персональный клиентский номер
        $this->setValue('1040', $date ['clientnumber']);

        $this->setValue('1050', $date ['ischanged']);

        //Дата
        $this->setValue('d-2.1', date("d"));

        $this->setValue('d-2.2', date("m"));

        $this->setValue('d-3.3', date("Y"));

        //Дата
        $this->setValue('d-1.1', date("d"));

        $this->setValue('d-1.2', date("m"));

        $this->setValue('d-1.3', date("Y"));

        $this->genirationXFDF();
    }

}
