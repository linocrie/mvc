<?php

namespace  System;


class Model{
    public $db;

    function __construct()
    {
        $this->db = new Db();
    }

    public function upload($file) {
        $uploadDir = '/Public/uploads/';
        $uploadFile = $uploadDir . basename($file['name']);
        if (move_uploaded_file($file['tmp_name'], SITE_ROOT.$uploadFile)) {
            return $uploadFile;
        } else {
            return false;
        }
    }

}