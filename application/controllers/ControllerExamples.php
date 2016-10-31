<?php

class ControllerExamples extends Controller {

    //Задача №1. Определить длину цепи между точками по координатам
    function action_testtask1() {
        $errors = [];
        $points = [];

        //Создаем точки
        $p1 = new Point(2, 8);
        $p2 = new Point(5, 6);
        $p3 = new Point(4, 4);
        $p4 = new Point(10, 5);
        $p5 = new Point(8, 2);

        //Возвращаем массив точек
        $points = Point::allPoints();

        //Количество точек в массиве
        $n = Point::count();
        echo $n.'</br>';
        //die;

        $L = [];
        $L2 = 0;
        $str='';
        
        //Расчет длины цепи
        for ($i = 0; $i <= ($n - 2); $i++) {
            $i1 = $i+1;
            $x1 = $points[$i]->x;
            $x2 = $points[$i1]->x;

            $y1 = $points[$i]->y;
            $y2 = $points[$i1]->y;

            $a1 = pow(($x1 - $x2), 2);
            $a2 = pow(($y1 - $y2), 2);

            $L[$i] = sqrt($a1 + $a2);
            
            $L2=$L2+$L[$i];

            $str = $str . "Отрезок $i1 --> point[$i]: ($x1, $y1) -  point[$i1]: ($x2, $y2)  | a1=$a1 | a2=$a2 | L[$i]=$L[$i] </br>";
            
        }
        
        $str=$str."</br> Ответ: $L2";
        
        //Рендерим вьюху
        $this->view->generate('example_view1.php', 'template_view.php', ['data' => $points, 'str'=>$str, 'errors' => $errors]);
    }

}
