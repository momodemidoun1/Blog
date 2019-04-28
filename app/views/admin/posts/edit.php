<?php
use Core\HTML\BootstrapForm;

$postTable = App::getInstance()->getTable('Post');
if (!empty($_POST)) {
    $result = $postTable->update($_GET['id'], [
        'titre' => $_POST['titre'],
        'contenu' => $_POST['contenu'],
        'category_id' => $_POST['category_id']
        ]);
    }
$post = $postTable->find($_GET['id']);
$form = new BootstrapForm($post);
$categories = App::getInstance()->getTable('Category')->extract('id', 'titre');
?>
<?php if (isset($result) && $result) : ?>
<div class="alert alert-success">L'article à bien été modifié.</div>
<?php endif ?>
<form action="" method="post">
    <?= $form->input('titre', 'Titre de l\'article') ?>
    <?= $form->input('contenu', 'Contenu', ['type' => 'textarea']) ?>
    <?= $form->select('category_id', 'Catégories', $categories) ?>
    <button type="submit" class="btn btn-primary">Sauvegarder</button>
</form>