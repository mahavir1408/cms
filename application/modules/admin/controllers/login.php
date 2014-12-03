<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {    
    
    public function __construct()
    {       
        parent::__construct(); 		
        $this->load->model('user_model');
        $this->load->helper('url');
        if($this->session->userdata('logged_in')){
            header('Location:/admin/dashboard');             
        }		
    }
    
    public function index()
    {
		$data = array();
        $this->load->library('form_validation');        
        $this->form_validation->set_error_delimiters('<div class="message error">', '</div>');
        if ( $this->form_validation->run('userlogin')) {    
			$userSessionData=$this->user_model->getUserDetails($this->input->post('email'),$this->input->post('password'));			
            $newdata = array(                  
                   'email'     => $userSessionData['userEmail'],
				   'name'		 =>	$userSessionData['userName'],
				   'id'		 => $userSessionData['userId'],
				   'last_access' => $userSessionData['userLastAccess'],
                   'logged_in' => true
               );			
            $this->session->set_userdata($newdata);
            header('Location:/admin/dashboard');
        }
        $userData = $this->session->all_userdata();
		
        $structure = array(				
            'title' => "HTML5 - Hands on UI",
            'keywords' =>"HTML5 - Hands on UI",
            'description' => "HTML5 - Hands on UI",
            'js' => 'backend/js/all.js',
            'css' => array('backend/css/all.css'),
			'misc_head' => '<!--[if gte IE 9]><link rel="stylesheet" href="/assets/backend/css/ie9.css" type="text/css" /><![endif]-->
			<!--[if gte IE 8]><link rel="stylesheet" href="/assets/backend/css/ie8.css" type="text/css" /><![endif]-->',
			//'meta' => array('<meta charset="utf-8" />','<meta name="author" content="" />','<meta name="viewport" content="width=device-width, initial-scale=1.0">')
			/*
			'meta' => array('author'=>'Mahavir Munot', 
							'viewport' => 'width=device-width, initial-scale=1.0',
							'copyright' => 'All content and images copyright &copy; 2013, addedbits'
							)
			*/
			'meta' => array('author'=>'Mahavir Munot', 
							'viewport' => 'width=device-width, initial-scale=1.0'							
							)
        );
		$this->config->set_item('structureFile', 'structure');
        //'header','left','content','footer'
         $views=array(             		 
			 'content' => 'login/login'			 
             );
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'0col');
        $this->hq_layout->set_data($data);
        $this->hq_layout->render();
    }
	
	public function userLogin()
    {		
        $isValid=$this->user_model->login_check($this->input->post('email'),$this->input->post('password'));
        if(!$isValid){
            $this->form_validation->set_message('userLogin', 'Incorrect Email address or Password.');
            return false;				
        }else{
            return true;
        }
    }
    
    public function logout()
    {        
        $this->session->sess_destroy();
        header('Location:/admin');
    }
}    