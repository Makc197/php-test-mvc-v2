<?php

class ControllerExample2 extends Controller {

    //Задача №2. Рисуем символ и сохраняем в BMP

    function action_reset() {
        header('Location: /example2/drawchar');
    }

    function action_drawchar() {
        $errors = [];
        $points = [];
        $str = '';
        
        
       $s=strtotime($str);
        
        
        //Рендерим вьюху
        $this->view->generate('example2_view.php', 'template_view.php', ['data' => $points, 'str' => $str, 'errors' => $errors]);
    }

}
