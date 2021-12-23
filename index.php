<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
use Config\Db;
// старе підключення - змінимо потім
require_once 'route/web.php';

//define controller and action
$controllerName = $_GET['controller'] ?? 'index';
$actionName = $_GET['action'] ?? 'index';

//завантажуємо об’єкт роутінга
$routing = new Route();
//завантажуємо об'єкт моделі
$db = new Db();

$routing->loadPage($db, $controllerName, $actionName);
