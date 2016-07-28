<?php

class ControllerCd extends Controller {
    
    function getAccess($action) {
        $access = isset($_SESSION['user']);
        return $access  && parent::getAccess($action);
    }

    function action_index() {
        $data = ModelCd::get_data();
        $this->view->generate('cd_list.php', 'template_view.php', $data);
    }

    function action_delete($id) {
        //var_dump('id='.$id);die;       
        ModelCd::delete_by_id($id);
        $data = ModelCd::get_data();
        $this->view->generate('cd_list.php', 'template_view.php', $data);
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
                header('Location: index.php?r=cd/index');
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