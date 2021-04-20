<?php

namespace Helpers;

class Upload {
    public $options = [
        "allowed_types" => ["jpg", "png", "jpeg", "gif"],
        "allowed_size" => 5,
        "change_name" => false
    ];
    public $error_msg;
    public function execute ($file , $target_dir){
        $upload = true;
        $file_type = strtolower(pathinfo($file["name"],PATHINFO_EXTENSION));
        $file_size = getimagesize($file["tmp_name"]);
        if(!$file_size){
            $this->error_msg = "Other type of file";
            $upload = false;
        }
        if($file_type != $this->options["allowed_types"][0] && $file_type != $this->options["allowed_types"][1] && $file_type != $this->options["allowed_types"][2] &&  $file_type != $this->options["allowed_types"][3] &&  $file_type != $this->options["allowed_types"][4]){
            $this->error_msg = "Choose right type of image";
            $upload = false;
        }
        if($file['size'] > $this->options["allowed_size"] * 1000000){
            $this->error_msg = "Such a large size pic";
            $upload = false;
        }
        if($upload) {
            if(move_uploaded_file($file["tmp_name"],  $target_dir)) {
                return $upload;
            }
            else {
                $upload = false;
                $this->error_msg = "Error";
            }
        }
        return $upload;
    }
}

//uploasic helnum a avatari pahy accountum ......file_name-y