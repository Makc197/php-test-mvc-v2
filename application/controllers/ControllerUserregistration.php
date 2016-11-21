<?php

namespace controllers;

use core\Controller;
use models\ModelUser;
use classes\Captcha;

Class ControllerUserregistration extends Controller {

    function action_create() {
        $user = new ModelUser();
        $errors = [];

        /*
          $roles_data = [];
          if ($roles = ModelUserrole::findAll())
          foreach ($roles as $r) {
          $roles_data[$r->id] = $r->role_name;
          }
         */

        if (isset($_POST['submit'])) {

            if (!isset($_SESSION["randStr"])) {
                $errors[] = "Включите отображение картинок в браузере";
            } else {
                if ($_SESSION["randStr"] == $_POST["answer"]) {
                    $_POST["role_id"] = "1";
                    //var_dump($_POST); die;
                    $login=$_POST["username"];
                    $user = ModelUser::get_user_by_username($login); //проверка на наличие пользователя с таким же username (login)
                    If (isset($user)) {
                        $errors[] = "Пользователь с таким username был зарегистрирован ранее";
                    } else {
                        //Регистрируем пользователя
                        $user = ModelUser::create_user($_POST); //создаем объект User
                        $errors[] = $user->validate(); //Проверяем введенные данные
                        if (empty($errors[0]) && $user->save()) {
                            header('Location: /authentication/login');
                        }
                    }
                } else {
                    $errors[] = "Неверно указан код с изображения";
                }
            }
        }

        $captha = Captcha::write();
        $this->view->generate('user_form' . DS . 'create_u.php', 'template_view.php', ['user' => $user, 'errors' => $errors, 'captha' => $captha]);
    }

}
