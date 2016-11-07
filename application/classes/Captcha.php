<?php
class Captcha {
    static function write() {
        // Создание изображения
        //$img = imageCreateTrueColor(500, 300);
        $img = imageCreateFromJpeg(SITE_PATH . '\images\noise.jpg');
        $color = imageColorAllocate($img, 64, 65, 68);
        imageAntiAlias($img, true);

        /* Рисуем текст */
        $nChars = 5;
        $randStr = substr(md5(uniqid()), 0, $nChars); //Случайный текст
        $_SESSION["randStr"] = $randStr; //Кладем текст в массив сессии в элемент randStr

        $x = 20;
        $y = 30;
        $deltaX = 40; //параметры отрисовки
        for ($i = 0; $i < $nChars; $i++) {
            $size = rand(18, 30);
            $angle = -30 + rand(0, 60); //Задаем случайный угол наклона символов
            imageTTFText($img, $size, $angle, $x, $y, $color, SITE_PATH . '\fonts\bellb.ttf', $randStr[$i]);
            $x += $deltaX;
        }

        /* Отдаем изображение */
        //header("Content-type: image/jpg");
 
        ob_start();

        imageJpeg($img, null, 50);
        $image_data = ob_get_contents();

        ob_end_clean();

        $image_data_base64 = base64_encode($image_data);
        $dataUri = "data:image/jpeg;base64," . $image_data_base64;
        
        return $dataUri;
        //return '<img src="' . $dataUri . '">';
    }

}
