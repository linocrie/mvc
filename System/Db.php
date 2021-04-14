<?php

namespace System;

use System\Model;

class Db extends \mysqli
{
    private $where_condition;
    function  __construct()
    {
        parent::__construct('localhost', 'root', '', 'internship');

        if ($this->connect_errno) {
            die("Connection failed: " . $this->connect_error);
        }
    }
    public function select($sql, $all = true)
    {
        $arr = [];
        $result = parent::query($sql);
        if(!$result->num_rows) return $arr;
        while ($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
        if ($all) {
            return $arr;
        }
        return $arr[0];
    }
    public function insert($tbl_name, $data)
    {
        $data_val = '';
        foreach ($data as $key => $value) {
            $data_val .= "'" . $this->real_escape_string(htmlspecialchars($value)) . "', ";
        }
        $data_val = substr($data_val, 0, -2);
        $query = parent::query("INSERT INTO $tbl_name(" . implode(",", array_keys($data)) . ")
        VALUES ($data_val)");
        return $query;
    }
    public function update($tbl_name, $fields, $where_condition)
    {
        $set = '';
        foreach ($fields as $key => $value) {
            $set .= $key . "='" . $this->real_escape_string(htmlspecialchars($value)) . "', ";
        }
        $set = substr($set, 0, -2);
        $where = '';
        if ($this->where_condition) {
            $where = " WHERE " . $this->where_condition;
        }
        $this->where_condition = '';
        $query = "UPDATE " . $tbl_name . " SET " . $set . $where;
        $upd_res = parent::query($query);
        return $upd_res;
    }
    public function delete($tbl_name, $where_condition)
    {
        $where = "";
        if ($this->where_condition) {
            $where = " WHERE " . $this->where_condition;
        }
        $this->where_condition = '';
        $query = "DELETE FROM " . $tbl_name . $where;
        $del_res = parent::query($query);
        return $del_res;
    }
    public function where($column, $value, $oper = '=')
    {
        if ($this->where_condition) {
            $this->where_condition .= " AND $column $oper $value ";
        } else {
            $this->where_condition .= " WHERE $column $oper $value ";
        }
        return $this;
    }
    public function or_where($column, $value, $oper = '=')
    {
        if ($this->where_condition) {
            $this->where_condition .= " OR $column $oper $value ";
        } else {
            $this->where_condition .= " WHERE $column $oper $value ";
        }
        return $this;
    }
}