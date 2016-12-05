<?php

namespace controllers;

use core\Controller;
use models\ModelProduct;
use classes\Paginator;
use classes\FProcess;

class ControllerProduct extends Controller {

    function getAccess($action) {

        //Никому не разрешим видеть - даже админу
        //И выведем сообщение
        //$errors=[];
        //$errors[] = 'Раздел сайта находится на реконструкции';
        //return ['errors'=>$errors];

        $errors = [];
        $access = isset($_SESSION['user']);

        if ($access && parent::getAccess($action)) {
            return true;
        } else {
            $errors[] = 'Необходимо авторизоваться';
            return ['errors' => $errors];
        }
    }

    function action_index() {
        $count = ModelProduct::getCountOfRows();
        $paginator = new Paginator($count, 10);
        $paginator->offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
        $data = ModelProduct::get_data($paginator);

        $this->view->generate('product_list.php', 'template_view.php', ['data' => $data, 'paginator' => $paginator]);
    }

    function action_delete($id) {
        ModelProduct::delete_by_id($id);
        header('Location: /product/index');
    }

    function action_create() {
        $errors = [];
        $product = new ModelProduct();
        $this->view->generate('product_form' . DS . 'update.php', 'template_view.php', ['product' => $product, 'errors' => $errors]);
    }

    function action_update($id) {
        // пришла форма с обновленными данными
        $errors = [];
        if (isset($_POST['submit'])) {
            $product = ModelProduct::loadData($_POST); //создаем объект ShopProduct
            $errors = $product->validate(); //Проверяем введенные данные
            if (!$errors && $product->save()) {
                header('Location: /product/index');
            }
        } else {
            $product = ModelProduct::get_by_id($id);
        }
        $this->view->generate('product_form' . DS . 'update.php', 'template_view.php', ['product' => $product, 'errors' => $errors]);
    }

    function action_view($id) {
        $product = ModelProduct::get_by_id($id);

        //Ниже тестирование функций обратного вызова
        //Создаем анонимную функцию - логирование действий и кладем ее в пременную $logger 
        $logger = function ($product) {
            print "Пользователь открыл на чтение {$product->getTitle()}\n";
        };
        
        //$processor = new FProcess(); //"Объект FProcess
        //$proceccor->registerCallback($logger); //Добавление функции обратного вызова которая создана здесь же (см выше) в массив функций
        //$proceccor->callCbFunct($product); //Вызов функций из массива - в качестве параметра объект $product
   
        FProcess::registerCallback($logger); //Добавление функции обратного вызова которая создана здесь же (см выше) в массив функций
        FProcess::callCbFunct($product); //Вызов функций из массива - в качестве параметра объект $product

        $errors = [];
        $this->view->generate('product_form' . DS . 'view.php', 'template_view.php', ['product' => $product, 'errors' => $errors]);
    }

}
