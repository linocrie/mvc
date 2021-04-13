<?php

namespace Controllers;
use System\Controller;

class Auth extends Controller {
    public function index() {
        echo "Auth Index";
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(empty($_POST['email'])){
                $this->view->email_error = 'Invalid Email';
            } else{
                var_dump($_POST);
            }
            if(empty($_POST['password'])){
                $this->view->pass_error = 'Invalid Password';
            }else{
                var_dump($_POST);
            }
        }
        $this->view->render("register");

    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(empty($_POST['email'])){
                $this->view->email_error = 'Invalid Email';
            } else{
                var_dump($_POST);
            }
            if(empty($_POST['password'])){
                $this->view->pass_error = 'Invalid Password';
            }else{
                var_dump($_POST);
                header('Location:dashboard.php');
            }
        }
        $this->view->render("login");
    }
}
