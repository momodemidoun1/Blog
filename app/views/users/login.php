<?php if ($errors) : ?>
    <div class="alert alert-danger">Identifiants incorrectes.</div>
<?php endif; ?>
<form action="" method="post">
    <?= $form->input('username', 'Pseudo') ?>
    <?= $form->input('password', 'Mot de passe', ['type' => 'password']) ?>
    <button class="btn btn-primary">Envoyer</button>
</form>