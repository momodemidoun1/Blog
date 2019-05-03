<?php

namespace App\Controller\Admin;

use \App;
use Core\HTML\BootstrapForm;

// TODO: document me

class PostsController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Post');
        $this->loadModel('Category');
    }

    public function index()
    {
        $posts = $this->Post->all();
        $this->render('admin.posts.index', compact('posts'));
    }

    public function edit()
    {
        $postTable = $this->Post;
        if (!empty($_POST)) {
            $result = $postTable->update($_GET['id'], [
                'titre' => $_POST['titre'],
                'contenu' => $_POST['contenu'],
                'category_id' => $_POST['category_id']
            ]);
        }
        if ($result) {
            return $this->index();
        }
        $post = $postTable->find($_GET['id']);
        $categories = $this->Category->extract('id', 'titre');
        $form = new BootstrapForm($post);
        $this->render('admin.posts.edit', compact('form', 'categories'));
    }

    public function add()
    {
        $categories = $this->Category->extract('id', 'titre');
        if (!empty($_POST)) {
            $result = $this->Post->create([
                'titre' => $_POST['titre'],
                'contenu' => $_POST['contenu'],
                'category_id' => $_POST['category_id']
            ]);
            if ($result) {
                return $this->index();
            }
        }
        $form = new BootstrapForm($_POST);
        $this->render('admin.posts.add', compact('form', 'categories'));
    }

    public function delete()
    {
        if (!empty($_POST)) {
            $result = $this->Post->delete($_POST['id']);
            return $this->index();
        }
    }
}
