<p class="container">
    <h1>Administrer les articles</h1>
    <p>
        <a href="?p=admin.posts.add" class="btn btn-success">Ajouter</a>
    </p>
    <table class="table">
        <thead>
        <tr>
            <td>Id</td>
            <td>Titre</td>
            <td>Actions</td>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post) : ?>
                <tr>
                    <td><?= $post->id ?></td>
                    <td><?= $post->titre ?></td>
                    <td>
                        <a href="?p=admin.posts.edit&id=<?= $post->id ?>" class="btn btn-primary">Editer</a>
                        <form action="?p=admin.posts.delete" style="display: inline" method="post">
                            <input type="hidden" name="id" value="<?= $post->id ?>">
                            <button class="btn btn-danger" href="?p=admin.posts.delete&id=<?= $post->id ?>" type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>





