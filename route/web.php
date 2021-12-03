<?php
class Route{
    function loadPage($db, $controllerName, $actionName = 'index'){
        include_once 'app/Controllers/IndexController.php';
        include_once 'app/Controllers/UsersController.php';
        include_once 'app/Controllers/RolesController.php';
        $controller = match ($controllerName) {
            'users' => new UsersController($db),
            'roles' => new RolesController($db),
            default => new IndexController($db),
        };
        // запускаємо необхідний метод
        $controller->$actionName();
    }
}
