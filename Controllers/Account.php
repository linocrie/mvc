<?php

namespace Controllers;

use System\Controller;
use System\Model;
use Models\User;
use Helpers\Upload;

class Account extends Controller
{
    private $user;

    public function __construct()
    {
        if (!isset($_SESSION["user_id"])) {
            header('Location: /auth/login');
        }
        parent::__construct();
        $this->user = new User;
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $upload = new Upload;
            $file_type = strtolower(pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION));
            $upload->options["change_name"] = true;
            if ($upload->options["change_name"]) {
                $file_name = date("H-i-s") . "." . $file_type;
            } else {
                $file_name = $_FILES["avatar"]["name"];
            }
            $target_dir = "./Public/Images/" . $file_name;
            $result = $upload->execute($_FILES['avatar'], $target_dir);
            if ($result) {
                $this->user->update_file($file_name, $_SESSION['user_id']);

            } else {
                $this->view->error = $upload->error_msg;
            }
        }
        $this->view->userInfo = $this->user->getUser($_SESSION['user_id']);
        $this->view->render("account");
    }

    public function friends()
    {
        $user = new User;
        $this->view->friends = $user->get_all_friends($_SESSION["user_id"]);
        $this->view->render("friends");
    }

    public function user($id)
    {
        $user = new User;
        $this->view->userInfo = $user->getUser($id);
        $this->view->render("account");
    }

    public function chat($user_id)
    {
        $user = new User;
        $this->view->userInfo = $user->getUser($_SESSION['user_id']);
        $this->view->toUserInfo = $user->getUser($user_id);
        $this->view->chat = $user->get_chat($_SESSION['user_id'],$user_id);
        $this->view->render("chat");
    }

    public function send_msg($user_id)
    {
        if (isset($_POST['chat'])) {
            $data = [
                "body" => $_POST['chat'],
                "from_id" => $_SESSION['user_id'],
                "to_id" => $user_id,
            ];
            $msg = $this->user->create_msg($data);
            echo json_encode($msg);
        }
    }
    public function get_msgs($to_id, $last_id) {
        $last_msg = $this->user->get_chat($_SESSION['user_id'],$to_id, $last_id);
        echo json_encode($last_msg);
    }
}



