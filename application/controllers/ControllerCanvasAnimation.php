<?php

namespace controllers;

use core\Controller;
use classes\Point;

//Рисуем анимацию в Canvas
class ControllerCanvasAnimation extends Controller {

    function action_clear() {
        unset($_SESSION['xy']);
        header('Location: /canvasanimation/animation1');
    }

    function action_animation1() {
        $errors = [];
        $points = [];
        $str = '';

        if (!empty($_SESSION['xy'])) {
            foreach ($_SESSION['xy'] as $value) {
                $p = new Point($value['x'], $value['y']);
            }

            //Возвращаем массив точек
            $points = Point::allPoints();
        }

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
        }

        //Рендерим вьюху
        $this->view->generate('canvasanimation1_view.php', 'template_view.php', ['data' => $points, 'str' => $str, 'errors' => $errors]);
    }

    function action_animation2() {

        $points = [];

        if (!empty($_SESSION['xy'])) {
            foreach ($_SESSION['xy'] as $value) {
                $p = new Point($value['x'], $value['y']);
            }

            //Возвращаем массив точек
            $points = Point::allPoints();
        }

        //Рендерим вьюху
        $this->view->generate('canvasanimation2_view.php', 'template_view.php', ['data' => $points]);
    }

    function action_clearanimation2() {
        header('Location: /canvasanimation/animation2');
    }

}
