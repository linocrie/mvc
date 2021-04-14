<?php

namespace Controllers;

use System\Controller;
use Models\User;

class Auth extends Controller {
    public function index() {
        echo "Auth Index";
    }
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(empty(htmlspecialchars($_POST['email'])) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || empty($_POST['password'])){
                $this->view->email_error = 'Invalid Email';
                $this->view->pass_error = 'Invalid Password';
            } else{
                $user = new User;
                if($user->create($_POST)){
                    header("Location: /account");
                }
                else{
                    $this->view->create_error = 'Something went wrong';
                }
            }
        }
        $this->view->render("register");
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(empty(htmlspecialchars($_POST['email'])) && empty($_POST['password'])){

                $this->view->email_error = 'Invalid Email';
                $this->view->pass_error = 'Invalid Password';
            } else{
                    $user = new User;
                    $result = $user->login($_POST['email'],$_POST['password']);
                    if(isset($result['id'])){
                        session_start();
                        $_SESSION['user_id'] = $result['id'];
                        header("Location: /account");
                    }
                    else{
                        $this->view->login_error = 'Something went wrong';
                    }
                }
        }
        $this->view->render("login");
    }

    public function logout() {
        session_start();
        unset($_SESSION['user_id']);
        session_destroy();
        header("Location: login");
    }
}
