<?php

class ControllerUsermanagement extends Controller
{

    function getAccess($action)
    {
        $access = isset($_SESSION['user']) &&
            ($_SESSION['user']['role_code'] == 'admin');
        return $access && parent::getAccess($action);
    }

    function action_index()
    {
        $data = ModelUser::get_data();
        //var_dump($data);die();
        $this->view->generate('user_list.php', 'template_view.php', ['data' => $data]);
    }

    function action_view($id)
    {
        $data = ModelUser::get_user_by_id($id);
        $errors = [];
        $this->view->generate('user_form' . DS . 'view.php', 'template_view.php', ['user' => $data, 'errors' => $errors]);
    }

    function action_create()
    {
        $user = new ModelUser();
        $errors = [];
        $roles_data = [];

        if ($roles = ModelUserrole::findAll()) foreach ($roles as $r) {
            $roles_data[$r->id] = $r->role_name;
        }

        if (isset($_POST['submit'])) {
            $user = ModelUser::create_user($_POST); //создаем объект User
            //$user->role_id = isset($_POST['role_id']) ? $_POST['role_id'] : null;
            
            $errors = $user->validate(); //Проверяем введенные данные
            //var_dump($errors);die;
            if (!$errors && $user->save()) {
                header('Location: index.php?r=usermanagement/index');
            }
        }
        
        $this->view->generate('user_form' . DS . 'create.php',
            'template_view.php',
            ['user' => $user, 'roles_data' => $roles_data, 'errors' => $errors]);

    }

    function action_update($id)
    {

        $errors = [];
        $user = ModelUser::get_user_by_id($id);
        $roles_data = [];
        if ($roles = ModelUserrole::findAll()) foreach ($roles as $r) {
            $roles_data[$r->id] = $r->role_name;
        }

        if (isset($_POST['submit'])) {
            $user = ModelUser::create_user($_POST); //создаем объект User
            $errors = $user->validate(); //Проверяем введенные данные
            if (!$errors && $user->save()) {
                header('Location: index.php?r=usermanagement/index');
            }
        }

        $this->view->generate('user_form' . DS . 'update.php',
            'template_view.php',
            ['user' => $user, 'roles_data' => $roles_data, 'errors' => $errors]);
    }

    function action_delete($id)
    {
        //var_dump('id='.$id);die;
        ModelUser::delete_by_id($id);
        $data = ModelUser::get_data();
        $this->view->generate('user_list.php', 'template_view.php', $data);
    }
}