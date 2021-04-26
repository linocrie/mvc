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
        return $this->db->select("SELECT id,name,user_avatar FROM users WHERE id =$id", false);
    }
    public function login($email, $password)
    {
        $password = md5($password);
        return $this->db->select("SELECT id FROM users WHERE email = '$email' AND password = '$password'", false);
    }
    public function update_file($file, $id) {
        $avatar = [
            "user_avatar" => $file,
        ];
        return $this->db->where('id', $id)->update("users", $avatar);
    }
    public function get_all_friends($id) {
        return $this->db->select("SELECT id,name,user_avatar FROM users WHERE id != $id");
    }
    public function create_msg($data) {
        return $this->db->insert("messages", $data);
    }
    public function get_chat($from_id, $to_id) {
        return $this->db->select("SELECT messages.id, messages.from_id, messages.body, date FROM messages LEFT JOIN users ON (messages.from_id = users.id) WHERE (from_id = $from_id AND to_id = $to_id) OR (from_id = $to_id AND to_id = $from_id) ORDER BY messages.id ASC");
    }
    public function get_last_id($from_id,$to_id) {
        return $this->db->select("SELECT id FROM messages WHERE (from_id = $from_id AND to_id = $to_id) OR (from_id = $to_id AND to_id = $from_id) ORDER BY id DESC ");
    }
    public function get_new_msg($from_id, $to_id, $last_id) {
        return $this->db->select("SELECT messages.id,users.name, messages.from_id, messages.body, date FROM messages LEFT JOIN users ON (messages.from_id = users.id) WHERE ((from_id = $from_id AND to_id = $to_id) OR (from_id = $to_id AND to_id = $from_id)) AND messages.id > $last_id ORDER BY messages.id ASC");
    }
}
