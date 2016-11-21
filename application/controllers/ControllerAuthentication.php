<?php
namespace controllers;

use core\Controller;
use models\ModelUser;

Class ControllerAuthentication extends Controller {

    function getAccess($action) {

        $access = ($action === 'action_login' || isset($_SESSION['user']));
        return $access && parent::getAccess($action);
    }

    function action_logout($login = null, $password = null) {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: /cd/index');
    }

    function action_login($login = null, $password = null) {
        //var_dump('Login'); die();
        $errors = [];
        if (!($login && $password)) {
            $this->view->generate('login_view.php', 'template_view.php', ['errors' => $errors]);
        }
        //Пробуем залогиниться
        elseif (ModelUser::login($login, $password)) { // Если логин и пароль заполнены
            header('Location: /main/index');
        } else {

            $errors[] = 'Ошибка аутентификации.';
            $this->view->generate('login_view.php', 'template_view.php', ['errors' => $errors]);
        }
    }

}
