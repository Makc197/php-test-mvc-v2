<?php

class Route {

    static function start() {
                
        // контроллер и действие по умолчанию
        $controller_name = 'Main';
        $action_name = 'index';   
        
        $params = [];
        
        $start = mb_strpos($_SERVER['REQUEST_URI'],'?');
        if($start){
            $paramsString = mb_substr($_SERVER['REQUEST_URI'], $start+1);
            parse_str($paramsString, $params);
        } 
        
        if(isset($params['r']))
        {
            $routes = explode('/', $params['r']);
            // получаем имя контроллера
            if (!empty($routes[0])) {
                $controller_name = $routes[0];
            }
            // получаем имя экшена
            if (!empty($routes[1])) {
                $action_name = $routes[1];
            }
            unset($params['r']);
        }
        
        
        // добавляем префиксы
        $model_name = 'Model' . ucfirst($controller_name);
        $controller_name = 'Controller' . ucfirst($controller_name);
        $action_name = 'action_' . $action_name;
        
        // подцепляем файл с классом модели (файла модели может и не быть)
        $model_file = $model_name. '.php';
              
        $model_path = "application/models/" . $model_file;
      
        if (file_exists($model_path)) {
            include "application/models/" . $model_file;
        }
        
        // подцепляем файл с классом контроллера
        $controller_file = strtolower($controller_name) . '.php';
        $controller_path = "application/controllers/" . $controller_file;
        if (file_exists($controller_path)) {
            include "application/controllers/" . $controller_file;
        } else {
            /*
              правильно было бы кинуть здесь исключение,
              но для упрощения сразу сделаем редирект на страницу 404
             */
            die('404');
            //Route::ErrorPage404();
        }
        
        // создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;       
                 
        if (method_exists($controller, $action)) {
            $params = $_REQUEST;
            $method_params = [];
            // вызываем действие контроллера
            $ref = new ReflectionMethod($controller_name, $action);    
            foreach( $ref->getParameters() as $argument) {
                if(isset($params[$argument->name])) $method_params[] = $params[$argument->name];
            }      
            $access = $controller->getAccess($action); //Разрешен доступ ?
            
            //Если разрешен - роутим дальше - определяем контроллер и действие - вызываем необх функцию
            if($access) call_user_func_array(array($controller, $action), array_values($method_params));
            //иначе - ошибка роутинга - ошибка 403
            else Route::ErrorPage403();
        } else {
            // здесь также разумнее было бы кинуть исключение
            // ошибка 404 - страница не найдена
            Route::ErrorPage404();
        }
    }

    function ErrorPage404() {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }
    
    function ErrorPage403() {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 403 Access denied');
        header("Status: 403 Access denied");
        header('Location:' . $host . '403');
    }


}
