<?php

namespace controllers;

use core\Controller;
use models\ModelUser;
use models\ModelUserrole;
use classes\Paginator;

class ControllerUsermanagement extends Controller {

    function getAccess($action) {
        $access = isset($_SESSION['user']) &&
                ($_SESSION['user']['role_code'] == 'admin');
        return $access && parent::getAccess($action);
    }

    function action_index() {
        $count = ModelUser::getCountOfRows();
        $paginator = new Paginator($count, 10);
        $paginator->offset = isset($_GET['offset']) ? $_GET['offset'] : 0;

        $data = ModelUser::get_data($paginator);
        //var_dump($data);die();
        $this->view->generate('user_list.php', 'template_view.php', ['data' => $data, 'paginator' => $paginator]);
    }

    function action_view($id) {
        $data = ModelUser::get_user_by_id($id);
        $errors = [];
        $this->view->generate('user_form' . DS . 'view.php', 'template_view.php', ['user' => $data, 'errors' => $errors]);
    }

    function action_create() {
        $user = new ModelUser();
        $errors = [];
        $roles_data = [];

        if ($roles = ModelUserrole::findAll())
            foreach ($roles as $r) {
                $roles_data[$r->id] = $r->role_name;
            }

        if (isset($_POST['submit'])) {
            $user = ModelUser::create_user($_POST); //создаем объект User
            
            $login = $_POST["username"];
            $user0 = ModelUser::get_user_by_username($login); //проверка на наличие пользователя с таким же username (login)
            If (isset($user0)) {
                $errors[] = "Пользователь с таким username был зарегистрирован ранее";
            } else {
                //Регистрируем пользователя
                $errors[] = $user->validate(); //Проверяем введенные данные
                if (empty($errors[0]) && $user->save()) {
                    header('Location: /usermanagement/index');
                }
            }
        }

        $this->view->generate('user_form' . DS . 'create.php', 'template_view.php', ['user' => $user, 'roles_data' => $roles_data, 'errors' => $errors]);
    }

    function action_update($id) {

        $errors = [];
        $user = ModelUser::get_user_by_id($id);
        $roles_data = [];
        if ($roles = ModelUserrole::findAll())
            foreach ($roles as $r) {
                $roles_data[$r->id] = $r->role_name;
            }

        if (isset($_POST['submit'])) {
            $user = ModelUser::create_user($_POST); //создаем объект User
            $errors = $user->validate(); //Проверяем введенные данные
            if (!$errors && $user->save()) {
                header('Location: /usermanagement/index');
            }
        }

        $this->view->generate('user_form' . DS . 'update.php', 'template_view.php', ['user' => $user, 'roles_data' => $roles_data, 'errors' => $errors]);
    }

    function action_delete($id) {
        ModelUser::delete_user_by_id($id);
        header('Location: /usermanagement/index');
    }

}
