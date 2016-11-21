<?php
namespace controllers;

use core\Controller;
use classes\Point;

class ControllerExample1 extends Controller {

    //Задача №1. Определить длину цепи между точками по координатам
    function action_reset() {
        unset($_SESSION['xy']);
        header('Location: /example1/calculate');
    }

    function action_calculate() {
        $errors = [];
        $points = [];
        $str = '';

        //Создаем точки
        //$p1 = new Point(2, 8);
        //$p2 = new Point(5, 6);
        //$p3 = new Point(4, 4);
        //print_r($_POST);die;

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
			
            //Обновляем массив точек
            //$points = Point::allPoints(); 
			
            if (is_numeric($x) and is_numeric($y)) {

                //Количество точек в массиве
                $n = Point::count();
                //echo $n . '</br>'; die;

                if ($n < 2) {
                    $errors[] = 'Для расчета длины цепи необходимо указать больше одной точки';
                } else {
                    $L = [];
                    $L2 = 0;

                    //Расчет длины цепи
                    for ($i = 0; $i <= ($n - 2); $i++) {
                        $i1 = $i + 1;
                        $x1 = $points[$i]->x;
                        $x2 = $points[$i1]->x;

                        $y1 = $points[$i]->y;
                        $y2 = $points[$i1]->y;

                        $a1 = pow(($x1 - $x2), 2);
                        $a2 = pow(($y1 - $y2), 2);

                        $L[$i] = sqrt($a1 + $a2);

                        $L2 = $L2 + $L[$i];

                        $str = $str . "Отрезок $i1 --> point[$i]: ($x1, $y1) -  point[$i1]: ($x2, $y2)  | L[$i]=$L[$i] </br>";
                    }

                    $str = $str . "</br> Ответ: $L2";
                }
            }

            if ($this->isAjaxRequest()) {
                die(json_encode($_SESSION['xy']));
            }
        }
        //Рендерим вьюху
        $this->view->generate('example1_view.php', 'template_view.php', ['data' => $points, 'str' => $str, 'errors' => $errors]);
    }

}
