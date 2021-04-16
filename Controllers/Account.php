<?php

namespace Controllers;
use System\Controller;
use Models\User;

class Account extends Controller{
    public function __construct() {
        $this->user = new User;
        if (!isset($_SESSION["user_id"])) {
            header('Location: /auth/login');
            exit;
        }
        parent::__construct();
    }
    public function index() {
        $get_user = $this->user->getUser($_SESSION['user_id']);
        $this->view->id = $get_user['id'];
        $this->view->name = $get_user['name'];
        $this->view->user_avatar = $get_user['user_avatar'];
        $this->view->render("account");
    }

    public function upload_avatar() {
        $user_id = $_GET['user_id'];
        $avatar = $this->user->uploadAvatar($user_id, $_FILES['avatar']);
        echo $avatar;
    }
}

