<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
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
		$this->load->view('login');
	}
    public function login()
    {
        ini_set('max_execution_time', 10000);

        $email    = $this->input->post("email");
        $password = $this->input->post("password");

        if(!empty($email) || !empty($password))
        {
            $criteria           = array();
            $criteria['email']  = $email;
            $userResult         = $this->registerModel->getbyIDEmail($criteria);
           
            if(!empty($userResult))
            {
                if(password_verify($password,$userResult->Password))
                {
                    $this->session->set_userdata("email",$userResult->Email);
                    redirect("/dashboard");
                }
                else
                {
                    $this->session->set_flashdata("error","Wrong Credentials");
                    redirect("login");
                }
            }
            else
            {
                $this->session->set_flashdata("error","Wrong Credentials");
                redirect("login");
            }
        }
    }
    
    public function logout()
    {
        ini_set('max_execution_time', 10000);

        $this->session->unset_userdata("email");
        $this->session->sess_destroy();

        redirect("login");
    }

}
