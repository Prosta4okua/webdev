<?php
class Route{
    function loadPage($db, $controllerName, $actionName = 'index'){
        include_once 'app/Controllers/IndexController.php';
        include_once 'app/Controllers/UsersController.php';
//      TODO вивчити match in php
        $controller = match ($controllerName) {
            'users' => new UsersController($db),
            default => new IndexController($db),
        };
        // запускаємо необхідний метод
        $controller->$actionName();
    }
}
