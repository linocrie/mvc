<?php

namespace Helpers;
use Models\User;

class Upload {
    private $allowed_file_types = array('jpg','jpeg','png','gif');
    private $allowed_size =  5;
    public $error_msg ;
    public function execute ($file , $location){
        $upload = true;
        $file_type = strtolower(pathinfo($file['avatar']['name'],PATHINFO_EXTENSION));
        $file_size = getimagesize($file['avatar']["tmp_name"]);
        $file_name= date("H-i-s"). "." . $file_type;
        $target_dir = "./Public/Images/".$file_name;
        if($file_size == false){
            $this->error_msg = "Such a big size pic";
            $upload = false;
        }
        if($file_type != $this->allowed_file_types[0] && $file_type != $this->allowed_file_types[1] && $file_type != $this->allowed_file_types[2] && $file_type != $this->allowed_file_types[3]){
            $this->error_msg = "Choose right type of image";
            $upload = false;
        }
        if($file['avatar']['size'] > $this->allowed_size * 1000000){
            $this->error_msg = "Such a large size pic";
            $upload = false;
        }
        if($upload){
            if(move_uploaded_file($file["avatar"]["tmp_name"], SITE_ROOT.$target_dir)){
                $user = new User;
                return $user->update_file($file_name, $_SESSION['user_id']);
            }
        }
        return $upload;
    }
}