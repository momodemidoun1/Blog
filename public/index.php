<?php
use App\Controller\PostsController;

define('ROOT', dirname(__DIR__));
require ROOT . '/vendor/autoload.php';

$app = App::getInstance();
$posts = $app->getTable('Post')->all();

if (isset($_GET['p'])) {
    $page = $_GET['p'];
} else {
    $page = 'home';
}

ob_start();
if ($page === 'home') {
    $controller = new PostsController();
    $controller->index();   
    die();
}elseif ($page === 'post.show') {
    require ROOT . '/pages/posts/show.php';
}elseif ($page === 'post.categorie') {
    require ROOT . '/pages/posts/categorie.php';
}elseif ($page === 'login') {
    require ROOT . '/pages/users/login.php';
}
$content = ob_get_clean();
require ROOT . '/pages/templates/default.php';





