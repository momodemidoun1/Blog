<?php

namespace App\Table;

use App\Entity\PostEntity;
use Core\Table\Table;

class PostTable extends Table
{

    /**
     * last Retrieve last posts
     * @return array
     */
    public function last(): array
    {
        return $this->query('
                SELECT post.id, post.titre, post.contenu, post.date, category.titre as categorie
                FROM post
                    LEFT JOIN category ON post.category_id = category.id
                ORDER BY post.date DESC');  
    }

    /**
     * findWithCategory Retrieve a single post linking it's category
     * @param $id int
     * @return PostEntity
     */
    public function findWithCategory(int $id) : PostEntity
    {
        return $this->query('
                SELECT post.id, post.titre, post.contenu, post.date, post.category_id, category.titre as categorie
                FROM post
                    LEFT JOIN category ON post.category_id = category.id
                    WHERE post.id = ?', [$id], true);
    }

    /**
     * lastByCategory Retrieve all posts from a demanded category
     * @param $categoory_id
     * @return array
     */
    public function lastByCategory(int $categoory_id): array
    {
        return $this->query('
                SELECT post.id, post.titre, post.contenu, post.date, category.titre as categorie
                FROM post
                    LEFT JOIN category ON post.category_id = category.id
                    WHERE post.category_id = ?', [$categoory_id]);

    }

}