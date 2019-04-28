<?php

$app = App::getInstance();
$post = $app->getTable('Post')->findWithCategory($_GET['id']);
$app->title = $post->titre;
?>
<h1><?= $post->titre ?></h1>
<p><em><?= $post->categorie ?></em></p>
<p><?= $post->contenu ?></p>
