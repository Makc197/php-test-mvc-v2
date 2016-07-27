<?php

class ControllerBook extends Controller {

    function getAccess($action) {
        $access = isset($_SESSION['user']);
        return $access  && parent::getAccess($action);
    }
    
    function action_index() {
        $data = ModelBook::get_data();
        $this->view->generate('book_list.php', 'template_view.php', $data);
    }

    function action_delete($id) {
        //var_dump('id='.$id);die;
        ModelBook::delete_by_id($id);
        $data = ModelBook::get_data();
        $this->view->generate('book_list.php', 'template_view.php', $data);
    }

    function action_create() {
        $errors = [];
        $book = new ModelBook();
        $this->view->generate('book_form' . DS . 'update.php', 'template_view.php', ['product' => $book, 'errors' => $errors]);
    }

    function action_update($id) {
        // пришла форма с обновленными данными
        $errors = [];
        if (isset($_POST['submit'])) {
            $book = ModelBook::loadData($_POST); //создаем объект BookProduct
            $errors = $book->validate(); //Проверяем введенные данные
            if (!$errors && $book->save()) {
                // redirect
                header('Location: index.php?r=book/index');
            }
        } else {
            $book = ModelBook::get_by_id($id);
        }
        $this->view->generate('book_form' . DS . 'update.php', 'template_view.php', ['product' => $book, 'errors' => $errors]);
    }

    function action_view($id) {
        $data = ModelBook::get_by_id($id);
        $errors = [];
        $this->view->generate('book_form' . DS . 'view.php', 'template_view.php', ['product' => $data, 'errors' => $errors]);
    }

}
