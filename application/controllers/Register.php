<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("registerModel");
        $this->load->library("General");
        
    }

	public function index()
	{
        $this->general->isAlreadyAuthenticated();
		$this->load->view('register');
	}

    public function register()
    {
        ini_set('max_execution_time', 10000);

        $data               = array();
        $data['username']   = $this->input->post("username");
        $data['email']      = $this->input->post("email");
        $data['password']   =  password_hash($this->input->post("password"),PASSWORD_BCRYPT);
        
        if(!empty($data['username']) && !empty($data['email']) && !empty($data['password']))
        {
            $criteria           = array();
            $criteria['email']  = $data['email'];
            $userResult         = $this->registerModel->getbyIDEmail($criteria);
           
            if(empty($userResult))
            {
                $id = $this->registerModel->add($data);
                if($id > 0)
                {
                     redirect("login");
                }
            }
            else
            {
                $this->session->set_flashdata("error","Email Already Exists.");
                redirect("register");
            }
        }
    }

}
