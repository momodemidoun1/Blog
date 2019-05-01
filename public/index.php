<?php
session_start();

define('ROOT', dirname(__DIR__));
require ROOT . '/vendor/autoload.php';
if (isset($_GET['p'])) {
    $page = $_GET['p'];
} else {
    $page = 'posts.index';
}
$page = explode('.', $page);
if ($page[0] === 'admin')
{
    $controller = '\App\Controller\Admin\\' . ucfirst($page[1]) . 'Controller';
    $action = $page[2];
} else {
    $action = $page[1];
    $controller = '\App\Controller\\' . ucfirst($page[0]) . 'Controller';
}
$controller = new $controller();
$controller->$action();






