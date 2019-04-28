<?php

use Core\HTML\BootstrapForm;


$form = new BootstrapForm($_POST);
$categories = App::getInstance()->getTable('Category')->extract('id', 'titre');
if (!empty($_POST)) {
    $result = App::getInstance()->getTable('Post')->create([
        'titre' => $_POST['titre'],
        'contenu' => $_POST['contenu'],
        'category_id' => $_POST['category_id']
    ]);
    if ($result) {
        header('Location: admin.php?p=post.edit&id=' . App::getInstance()->getTable('Post')->lastInsertId());
    }
}
?>
<?php if (isset($result) && $result) : ?>
    <div class="alert alert-success">L'article à bien été ajouté.</div>
<?php endif ?>
<form action="" method="post">
    <?= $form->input('titre', 'Titre de l\'article') ?>
    <?= $form->input('contenu', 'Contenu', ['type' => 'textarea']) ?>
    <?= $form->select('category_id', 'Catégories', $categories) ?>
    <button type="submit" class="btn btn-primary">Sauvegarder</button>
</form>