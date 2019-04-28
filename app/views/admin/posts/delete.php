<?php
$post = App::getInstance()->getTable('Post');
if (!empty($_POST)) {
    $result = $post->delete($_POST['id']);
    header('Location: admin.php');
}
