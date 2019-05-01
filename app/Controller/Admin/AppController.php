<?php

namespace App\Controller\Admin;

use Core\Auth\DBAuth;
use \App;
//TODO: document all functions 
class AppController extends \App\Controller\AppController
{ 
    public function __construct()
    {
        parent::__construct();
        $app = App::getInstance();
        $auth = new DBAuth($app->getDb());
        if (!$auth->logged()) {
            $this->forbidden();
        }
    }
}
