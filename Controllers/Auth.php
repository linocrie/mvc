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
            if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $this->view->email_error = 'Invalid Email';
            }
            elseif (empty($_POST['password'])){
                $this->view->pass_error = 'Invalid Password';
            }
            elseif (empty($_POST['name'])){
                $this->view->name_error = 'Please type your name';
            }

            else{
                $user = new User;
                if($user->create($_POST)){
                    header("Location: /auth/login");
                }
                else{
                    $this->view->create_error = 'Something went wrong';
                }
            }
        }
        $this->view->render("register",false);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(empty($_POST['email'])){
                $this->view->email_error = 'Invalid Email';
            }elseif (empty($_POST['password'])){
                $this->view->pass_error = 'Invalid Password';
            }
            else{
                  $user = new User;
                  $result = $user->login($_POST['email'],$_POST['password']);
                  if(isset($result['id'])){
                     $_SESSION['user_id'] = $result['id'];
                      header("Location: /account");
                  }
                   else{
                      $this->view->login_error = 'Something went wrong';
                   }
            }
        }
        $this->view->render("login",false);
    }
    public function logout() {
        session_destroy();
        header("Location: /auth/login");
    }
}
