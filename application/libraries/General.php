<?php 

class General
{
    public function authentication()
    {
        $CI =& get_instance();
        if (!$CI->session->userdata('email'))
        {
            redirect('login');
        }
        
    }
    public function isAlreadyAuthenticated()
    {
        $CI =& get_instance();
        if ($CI->session->userdata('email'))
        {
            redirect('dashboard');
        }
        
    }
}

?>