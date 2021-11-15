<!--
Badge = alert з цифрами?
Breadcrumb = хлібна крихта
-->
<?php
session_start();
require_once 'config/db.php';
require_once 'route/web.php';

//define controller and action
$controllerName = $_GET['controller'] ?? 'index';
$actionName = $_GET['action'] ?? 'index';

//завантажуємо об’єкт роутінга
$routing = new Route();
//завантажуємо об'єкт моделі
$db = new Db();

$routing->loadPage($db, $controllerName, $actionName);
