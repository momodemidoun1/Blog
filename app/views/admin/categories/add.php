<?php

use Core\HTML\BootstrapForm;


if (!empty($_POST)) {
    $result = App::getInstance()->getTable('Category')->create([
        'titre' => $_POST['titre']
    ]);
    if ($result) {
        header('Location: admin.php?p=categories.index');
    }
}
$form = new BootstrapForm($_POST);
?>
<?php if (isset($result) && $result) : ?>
    <div class="alert alert-success">La categorie à bien été ajouté.</div>
<?php endif ?>
<form action="" method="post">
    <?= $form->input('titre', 'Titre de la categorie') ?>
    <button type="submit" class="btn btn-primary">Sauvegarder</button>
</form>