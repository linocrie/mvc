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
        $from_id = $user_id;
        $this->view->userInfo = $user->getUser($_SESSION['user_id']);
        $this->view->toUserInfo = $user->getUser($from_id);
        $this->view->chat = $user->get_chat($from_id, $_SESSION['user_id']);
        $msg = $this->user->get_last_id($_SESSION['user_id'], $user_id);
        $this->view->getLastMsg = isset($msg[0]['id']) ? $msg[0]['id'] : 0;
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

    public function get_last_msg_id($user_id)
    {
        $user = new User;
        $last_id = $user->get_last_id($_SESSION['user_id'], $user_id);
        $response = count($last_id) ? $last_id[0]['id'] : 0;
        echo json_encode($response, JSON_NUMERIC_CHECK);
    }
    public function get_msgs_ajax($from_id,$last_id) {
        $user = new User;
        $chat = $user->get_new_msg($from_id, $_SESSION['user_id'], $last_id);
        echo json_encode($chat);
    }

}



