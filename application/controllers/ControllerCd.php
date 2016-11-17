<?php

class ControllerCd extends Controller {
    
    function getAccess($action) { // ????Перенести в родительский класс

        $errors = [];
        $access = isset($_SESSION['user']);
        // return $access  && parent::getAccess($action);
        if ($access && parent::getAccess($action)){
            return true;
        }  else {
            $errors[] = 'Необходимо авторизоваться';
            return ['errors'=>$errors];
        }
        
    }
    
    function action_index()
    {
        $count = ModelCd::getCountOfRows();
        $paginator = new Paginator($count, 10);
        $paginator->offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
        $data = ModelCd::get_data($paginator);

        $this->view->generate('cd_list.php',
            'template_view.php',
            ['data' => $data, 'paginator' => $paginator]);
    }

    function action_delete($id) {
     
        ModelCd::delete_by_id($id);
        header('Location: /cd/index');
    }

    function action_create() {
        $errors = [];
        $cd = new ModelCD();
        $this->view->generate('cd_form' . DS . 'update.php', 'template_view.php', ['product' => $cd, 'errors' => $errors]);
    }

    function action_update($id) {
        // пришла форма с обновленными данными
        $errors = [];
        if (isset($_POST['submit'])) {
            $cd = ModelCd::loadData($_POST); //создаем объект CDProduct
            $errors = $cd->validate(); //Проверяем введенные данные
            
            if (!$errors && $cd->save()) {
                // redirect
                header('Location: /cd/index');
            }
        } else {
            $cd = ModelCD::get_by_id($id);
        }
        //var_dump($cd); die;
        $this->view->generate('cd_form' . DS . 'update.php', 'template_view.php', ['product' => $cd, 'errors' => $errors]);
    }

    function action_view($id) {
        $cd = ModelCd::get_by_id($id);
        $errors = [];
        $this->view->generate('cd_form' . DS . 'view.php', 'template_view.php', ['product' => $cd, 'errors' => $errors]);
    }
}
