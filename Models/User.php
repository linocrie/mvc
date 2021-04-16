<?php

namespace Models;

use System\Model;
class User extends Model
{
    public function create($data) {
        $data['password'] = md5($data['password']);
        return $this->db->insert('users',$data);
    }
    public function getUser($id) {
        return $this->db->select('SELECT id,name,email,user_avatar FROM users WHERE id ='.$id, false);
    }
    public function login($email, $password)
    {
        $password = md5($password);
        return $this->db->select("SELECT id FROM users WHERE email = '$email' AND password = '$password'", false);
    }
    public function uploadAvatar($id, $file) {
        $uploadFile = $this->upload($file);
        if ($uploadFile) {
            $this->db->update('users', ['user_avatar' => $file['name']], 'id = '.$id);
            return $uploadFile;
        }
        return false;
    }
}