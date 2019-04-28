<?php

use Core\HTML\BootstrapForm;

$categoryTable = App::getInstance()->getTable('Category');
if (!empty($_POST)) {
    $result = $categoryTable->update($_GET['id'], [
        'titre' => $_POST['titre']
        ]);
    }
$category = $categoryTable->find($_GET['id']);
$form = new BootstrapForm($category);
$categories = App::getInstance()->getTable('Category')->extract('id', 'titre');
?>
<?php if (isset($result) && $result) : ?>
<div class="alert alert-success">La catégorie à bien été modifié.</div>
<?php endif ?>
<form action="" method="post">
    <?= $form->input('titre', 'Titre de la catégorie') ?>
    <button type="submit" class="btn btn-primary">Sauvegarder</button>
</form>
