<?php

namespace App\Controller;

use Core\Controller\Controller;
use \App;

//TODO: document all functions 
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
      $categories = $this->Category->all();
      $posts = $this->Post->last();
      $this->render('posts.index', compact('posts', 'categories'));
   }

   public function category()
   {
      $categorie = $this->Category->find($_GET['id']);
      if ($categorie === false) {
         $this->notFound();
      }
      $posts = $this->Post->lastByCategory($_GET['id']);
      $categories = $this->Category->all();
      $this->render('posts.categorie', compact('posts', 'categories', 'categorie'));
   }

   public function show()
   {
      $post = $this->Post->findWithCategory($_GET['id']);
      App::getInstance()->title = $post->titre;
      $title = App::getInstance()->title;
      $this->render('posts.show', compact('post', 'title'));
   }
}
