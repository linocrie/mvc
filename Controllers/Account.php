<?php

namespace Controllers;
use System\Controller;
use Models\User;

class Account extends Controller{
    public function __construct() {
        session_start();
        if (!isset($_SESSION["user_id"])) {
            header('Location: /auth/login');
            exit;
        }
        parent::__construct();
    }
    public function index() {
        $user = new User;
        $get_user = $user->getUser($_SESSION['user_id']);
        $this->view->email  = $get_user['email'];
        $this->view->render("account");
    }
}

