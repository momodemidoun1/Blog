<p class="container">
    <h1>Administrer les categories</h1>
    <p>
        <a href="?p=admin.categories.add" class="btn btn-success">Ajouter</a>
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
            <?php foreach ($categories as $category) : ?>
                <tr>
                    <td><?= $category->id ?></td>
                    <td><?= $category->titre ?></td>
                    <td>
                        <a href="?p=admin.categories.edit&id=<?= $category->id ?>" class="btn btn-primary">Editer</a>
                        <form action="?p=admin.categories.delete" style="display: inline" method="post">
                            <input type="hidden" name="id" value="<?= $category->id ?>">
                            <button class="btn btn-danger"  type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>





