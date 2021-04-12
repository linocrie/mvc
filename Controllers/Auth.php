<?php

namespace Controllers;
use System\Controller;

class Auth extends Controller {
    public function index() {
        echo "Auth Index";
    }

    public function register() {
        if (!$_POST) {
            $this->view->render("register", true);
        } else {
            print_r($_POST);
        }
    }

    public function login() {
        if (!$_POST) {
            $this->view->render("login", true);
        } else {
            print_r($_POST);
        }
    }
}
