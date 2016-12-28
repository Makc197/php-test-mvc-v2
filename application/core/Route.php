<?php

namespace core;

use controllers;
use classes\exceptions\RouterException;

class Route {

    static function start() {

        // контроллер и действие по умолчанию
        $controller_name = 'Main';
        $action_name = 'index';

        $params = [];

        $routes = explode('/', $_SERVER['REQUEST_URI']);
        array_shift($routes);

        // получаем имя контроллера
        if (!empty($routes[0])) {
            $controller_name = $routes[0];
        }
        // получаем имя экшена
        if (!empty($routes[1])) {
            $action_name = explode('?', $routes[1])[0];
            //$params=urldecode(explode('?', $routes[1])[1]);
        }

        // добавляем префиксы
        $model_name = 'Model' . ucfirst($controller_name);
        $controller_name = 'Controller' . ucfirst($controller_name);
        $action_name = 'action_' . $action_name;

        // подцепляем файл с классом модели (файла модели может и не быть)
        $model_file = $model_name . '.php';

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
            throw new RouterException('Страница не существует.', 404);
            //Route::ErrorPage404();
        }

        // создаем контроллер
        $controller_name = "controllers\\" . $controller_name;

        $controller = new $controller_name;
        $action = $action_name;

        if (method_exists($controller, $action)) {
            $params = $_REQUEST;
            $method_params = [];

            // вызываем действие контроллера
            $ref = new \ReflectionMethod($controller_name, $action);
            foreach ($ref->getParameters() as $argument) {
                if (isset($params[$argument->name]))
                    $method_params[] = $params[$argument->name];
            }
            $access = $controller->getAccess($action); //Разрешен доступ ?
            //Если разрешен - роутим дальше - определяем контроллер и действие - вызываем необх функцию
            if (!$access['errors'] & $access) { // Если нет ошибок и доступ разрешен ???
                call_user_func_array(array($controller, $action), array_values($method_params));
            }
            //elseif ($access['errors']) { // Если есть ошибки - отображаем ???
                //$controller->view->generate('main_view.php', 'template_view.php', ['errors' => $access['errors']]);
            //}
            //иначе - ошибка роутинга - ошибка 403
            else {
                throw new RouterException('Доступ запрещен',403);
                //Route::ErrorPage403();
            }
        } else {
            // ошибка 404 - страница не найдена
            throw new RouterException('Страница не найдена',404);
            //Route::ErrorPage404();
        }
    }

    static function ErrorPage404($message) {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        die($message);
    }

    static function ErrorPage403($message) {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 403 Access denied');
        header("Status: 403 Access denied");
        die($message);
    }

}
