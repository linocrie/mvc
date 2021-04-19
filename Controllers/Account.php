<?php

namespace Controllers;
use System\Controller;
use Models\User;
use Helpers\Upload;

class Account extends Controller{
    public function __construct() {
        if (!isset($_SESSION["user_id"])) {
            header('Location: /auth/login');
        }
        parent::__construct();
    }
    public function index() {
        $user = new User;
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $upload = new Upload;
            $target_dir = "./Public/Images/".$_FILES['avatar']['name'];
            $result =$upload->execute($_FILES, $target_dir);
            if(!$result) {
                $this->view->error_msg = 'Error';
            }
        }
        $userInfo = $user->user_info($_SESSION['user_id']);
        $this->view->id = $_SESSION['user_id'];
        $this->view->userInfo = $userInfo[0];
        $this->view->render("account");
    }
    public function upload_avatar() {
        $upload = new Upload();
        if ($upload->execute($_FILES, '')) {
            header('location:/account');
        }
    }
    public function friends() {
        $user = new User;
        $this->view->friends =  $user->get_all_friends($_SESSION["user_id"]);
        $this->view->render("friends");
    }
    public function user($id) {
        $user = new User;
        $this->view->userInfo = $user->user_info($id)[0];
        $this->view->friends_account = true;
        $this->view->render("account");
    }
}

