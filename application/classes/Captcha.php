<?php
namespace classes;

class Captcha {
    static function write() {
        // Создание изображения
        //$img = imageCreateTrueColor(500, 300);
        
        //var_dump(SITE_PATH); die;
        
        $img = imageCreateFromJpeg(SITE_PATH . '\images\noise.jpg');
        $color = imageColorAllocate($img, 64, 65, 68);
        imageAntiAlias($img, true);

        /* Рисуем текст */
        $nChars = 5;
        $randStr = substr(md5(uniqid()), 0, $nChars); //Случайный текст
        $_SESSION["randStr"] = $randStr; //Кладем текст в массив сессии в элемент randStr

        $x = 40;
        $y = 45;
        $deltaX = 40; //параметры отрисовки
        for ($i = 0; $i < $nChars; $i++) {
            $size = rand(27, 38);
            $angle = -30 + rand(0, 60); //Задаем случайный угол наклона символов
            imageTTFText($img, $size, $angle, $x, $y, $color, SITE_PATH . '\fonts\bellb.ttf', $randStr[$i]);
            $x += $deltaX;
        }

        /* Отдаем изображение */
        //header("Content-type: image/jpg");
            
        //Прогоняем ресурс (получившееся изображение jpg) через кеш
        ob_start();

        imageJpeg($img, null, 50);
        $image_data = ob_get_contents();

        ob_end_clean();
        
        //Оборачиваем полученные данные base64
        $image_data_base64 = base64_encode($image_data);
        $dataUri = "data:image/jpeg;base64," . $image_data_base64;
        
        return $dataUri;
        //return '<img src="' . $dataUri . '">';
    }

}
