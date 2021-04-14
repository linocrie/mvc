<?php

namespace Controllers;

use System\Controller;
use Models\User;

class Home extends Controller{
    public function index() {
        $this->view->render('basic', true);
    }
}

