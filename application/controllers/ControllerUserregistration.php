<?php

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
                    $user = ModelUser::create_user($_POST); //создаем объект User

                    $errors[] = $user->validate(); //Проверяем введенные данные
                    //var_dump($errors);
                    //die;

                    if (empty($errors[0]) && $user->save()) {
                        header('Location: index.php?r=authentication/login');
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
