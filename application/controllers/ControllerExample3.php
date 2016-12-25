<?php

namespace controllers;

use core\Controller;
use classes\Point;

//Рисуем анимацию в Canvas
class ControllerExample3 extends Controller {
    
    function action_stopanimation() {
        unset($_SESSION['xy']);
        header('Location: /example3/animation');
    }
    
    function action_animation (){
       
        $errors = [];
        $points = [];
        $str = '';
       
       //var_dump($_SESSION['xy']); die;
        
       //Пересчитываем массив $points из $_SESSION['xy'] при Submit из вьюхи
        if (!empty($_SESSION['xy'])) {
            foreach ($_SESSION['xy'] as $value) {
                $p = new Point($value['x'], $value['y']);
            }

            //Возвращаем массив точек
            $points = Point::allPoints();
        }
        
        //Добавляем в массив $_SESSION['xy'] координаты точек асинхронно - из js\example3
        if (!empty($_POST['Math_x']) && !empty($_POST['Math_y'])) {
            $post = $_POST;

            $x = $post['Math_x'];
            $y = $post['Math_y'];

            if (trim($x) == '') {
                $errors[] = 'Укажите координату X';
            }

            if (trim($y) == '') {
                $errors[] = 'Укажите координату Y';
            }

            $_SESSION['xy'][] = ['x' => $x, 'y' => $y];
			
            //Обновляем массив точек
            //$points = Point::allPoints(); 
            
            //if ($this->isAjaxRequest()) {
            //    die(json_encode($_SESSION['xy']));
            //}
        }
                
        //Рендерим вьюху
        $this->view->generate('example3_view.php', 'template_view.php', ['data' => $points, 'str' => $str, 'errors' => $errors]);
    }
}
