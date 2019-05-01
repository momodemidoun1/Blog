<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <ul>
                <?php foreach ($posts as $post) : ?>
                    <h2> <?= '<a href="' . $post->url . '">'  ?> <?= $post->titre ?> </a></h2>
                    <p><em><?= $post->categorie ?> </em></p>
                    <p><?= $post->extract ?></p>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="col-sm-4">
            <ul>
                <?php foreach ($categories as $category) : ?>
                    <li> <?= '<a href="'  . $category->url . '">' ?><?= $category->titre ?> </a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>