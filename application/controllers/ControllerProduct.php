<?php

class ControllerProduct extends Controller {
    
    function getAccess($action) {
        //$access = isset($_SESSION['user']);
        //return $access  && parent::getAccess($action);
        
        //Никому не разрешим видеть - даже админу
        //И выведем сообщение
        $errors=[];
        $errors[] = 'Раздел сайта находится на реконструкции';
        return ['errors'=>$errors];
    }
    
    function action_index() {
        $count = ModelProduct::getCountOfRows();
        $paginator = new Paginator($count, 10);
        $paginator->offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
        $data = ModelProduct::get_data($paginator);
       
        $this->view->generate('product_list.php', 
            'template_view.php', 
            ['data'=>$data, 'paginator'=>$paginator]);
    }

    function action_delete($id) {
        //var_dump('id='.$id);die;
        ModelProduct::delete_by_id($id);
        $data = ModelProduct::get_data();
        $this->view->generate('product_list.php', 'template_view.php', $data);
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
                
                header('Location: index.php?r=product/index');
            }
        } else {
            $product = ModelProduct::get_by_id($id);
        }
        $this->view->generate('product_form' . DS . 'update.php', 'template_view.php', ['product' => $product, 'errors' => $errors]);
    }

    function action_view($id) {
        $data = ModelProduct::get_by_id($id);
        $errors = [];
        $this->view->generate('product_form' . DS . 'view.php', 'template_view.php', ['product' => $data, 'errors' => $errors]);
    }

}
