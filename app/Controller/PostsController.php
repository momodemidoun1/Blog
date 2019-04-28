<?php

namespace App\Controller;

use Core\Controller\Controller;

class PostsController extends Controller 
{
   public function index()
   {
        ob_start();
        require ROOT . '/app/views/posts/home.php';
        $content = ob_get_clean();
        require ROOT . '/app/views/templates/default.php'; 
   }

   public function categories()
   {

   }

   public function show() 
   {

   }
}