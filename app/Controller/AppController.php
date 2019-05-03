<?php
    
namespace App\Controller;

use Core\Controller\Controller;
use \App;

//TODO: document all functions 
class AppController extends Controller
{
    protected $template = 'default';

    public function __construct()
    {
        $this->viewPath = ROOT . '/app/views/';
    }

    protected function loadModel($model_name)
    {
        $this->$model_name =  App::getInstance()->getTable($model_name);
    }
}
