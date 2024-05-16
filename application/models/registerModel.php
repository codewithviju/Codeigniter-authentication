<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class registerModel extends CI_Model
{
    var $table = "isuser";

    public function __construct()
    {
        parent::__construct();
    }

    public function add($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function getbyIDEmail($criteria = array())
    {
        $this->db->get("*");
        $this->db->from($this->table);
        if(!empty($criteria['email']))
        {
            $this->db->where("email",$criteria['email']);
        }
        $query = $this->db->get();
        return $query->row(); 
    }


    public function getByEmailAndPassword($email, $password)
    {
        $query = $this->db->get_where($this->table, array('email' => $email));
        $user = $query->row();

        if ($user && password_verify($password, $user->Password))
        {
            echo "hello";exit;
            return $user;
        }
        else
        {
            echo "no";exit;
            return false;
        }
    }
}
