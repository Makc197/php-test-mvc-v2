<?php

class ControllerAdmin extends Controller {

    function getAccess($action) {
        $access = isset($_SESSION['user']) && 
                ($_SESSION['user']['role_code'] == 'admin');
        return $access  && parent::getAccess($action);
    }
    
    function action_index() {
        die('<a href="/?r=usermanagement/index">Users</a>');
        $this->view->generate('user_list.php', 'template_view.php', $data);
    }

}