<?php

namespace App\Table;
use Core\Table\Table;

class CategoryTable extends Table
{

    /**
     * last Retrieve last postS
     * @return array
     */
    public function lastByCategory($id): array
    {
        return $this->query('
                SELECT post.id, post.titre, post.contenu, post.date, category.titre as categorie
                FROM post
                    LEFT JOIN category ON post.category_id = category.id
                    WHERE post.category_id = ?', [$id]);

    }

}