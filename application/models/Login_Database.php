<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Login_Database extends CI_Model {


    public function registration_insert($data)
    {
        $condition = "username =" . "'" . $data['username'] . "'";
        $this->db->select('*');
        $this->db->from('et_panel_users');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->insert('et_panel_users', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            return false;
        }
    }




    public function AsLogin($username,$password){
        $Data = array(
            'username'  => $username,
            'password'  => $password
        );

        return $this->Login_Database->login($Data,false);
    }


    public function login($data,$crypt) {

        $password = $crypt ? sha1($data['password']) : $data['password'];
        $condition = "username =" . "'" . $data['username'] . "' AND " . "password =" . "'" . $password . "'";
        $this->db->select('*');
        $this->db->from('et_panel_users');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }


    public function read_user_information($username) {

        $condition = "username =" . "'" . $username . "'";
        $this->db->select('*');
        $this->db->from('et_panel_users');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

}

?>