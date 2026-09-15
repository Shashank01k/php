<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $table = 'users';

    public function insert_user($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function email_exists($email)
    {
        return $this->db
            ->where('email', $email)
            ->count_all_results($this->table) > 0;
    }

    public function get_users()
    {
        return $this->db
            ->select('users.*, states.name AS state_name')
            ->from('users')
            ->join('states', 'states.id = users.state_id', 'left')
            ->order_by('users.id', 'DESC')
            ->get()
            ->result();
    }

    public function get_user_by_id($id)
    {
        return $this->db
            ->where('id', $id)
            ->get($this->table)
            ->row();
    }

    public function update_user($id, $data)
    {
        return $this->db
            ->where('id', $id)
            ->update($this->table, $data);
    }

    public function delete_user($id)
    {
        return $this->db
            ->where('id', $id)
            ->delete($this->table);
    }
}