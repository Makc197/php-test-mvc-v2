<?php

class ControllerBook extends Controller
{

    function getAccess($action)
    {
        // $access = isset($_SESSION['user']);
        // return $access && parent::getAccess($action);
        // 
        //По дефолту разрешим всем видеть
        //return true;

        $errors = [];
        $access = isset($_SESSION['user']);
        // return $access  && parent::getAccess($action);
        if ($access && parent::getAccess($action)) {
            return true;
        } else {
            $errors[] = 'Необходимо авторизоваться';
            return ['errors' => $errors];
        }
    }

    function action_index()
    {
        $count = ModelBook::getCountOfRows();
        $paginator = new Paginator($count, 10);
        $paginator->offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
        $data = ModelBook::get_data($paginator);

        $this->view->generate('book_list.php', 'template_view.php', ['data' => $data, 'paginator' => $paginator]);
    }

    function action_delete($id)
    {

        $c = ModelBook::delete_by_id($id);

        if($this->isAjaxRequest()) {
            die(json_encode($c));
        }

        header('Location: /book/index');
    }

    function action_create()
    {
        $errors = [];
        $book = new ModelBook();
        $this->view->generate('book_form' . DS . 'update.php', 'template_view.php', ['product' => $book, 'errors' => $errors]);
    }

    function action_update($id)
    {
        // пришла форма с обновленными данными
        $errors = [];
        if (isset($_POST['submit'])) {
            $book = ModelBook::loadData($_POST); //создаем объект BookProduct
            $errors = $book->validate(); //Проверяем введенные данные
            if (!$errors && $book->save()) {
                // redirect
                header('Location: /book/index');
            }
        } else {
            $book = ModelBook::get_by_id($id);
        }
        $this->view->generate('book_form' . DS . 'update.php', 'template_view.php', ['product' => $book, 'errors' => $errors]);
    }

    function action_view($id)
    {
        $data = ModelBook::get_by_id($id);
        $errors = [];
        $this->view->generate('book_form' . DS . 'view.php', 'template_view.php', ['product' => $data, 'errors' => $errors]);
    }

}
