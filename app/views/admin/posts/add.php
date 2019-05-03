<form action="" method="post">
    <?= $form->input('titre', 'Titre de l\'article') ?>
    <?= $form->input('contenu', 'Contenu', ['type' => 'textarea']) ?>
    <?= $form->select('category_id', 'Catégories', $categories) ?>
    <button type="submit" class="btn btn-primary">Sauvegarder</button>
</form>