<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {  

	public $data = array();
    
    public function __construct()
    {       
        parent::__construct(); 		
        $this->load->model('user_model');
        if(!$this->session->userdata('logged_in')){
            header('Location:/admin');
            exit;
        }        
        $this->config->set_item('menu', 'dashboard');
		$this->data['userData'] = $this->session->all_userdata();
    }
    
    public function index()
    {
        //$data['test'] = 'test';
        $structure = array(				
            'title' => "HTML5 - Hands on UI",
            'keywords' =>"HTML5 - Hands on UI",
            'description' => "HTML5 - Hands on UI",
            'js' => 'backend/js/all.js',
            'css' => array('backend/css/all.css','backend/css/people.css'),
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
             'header' => 'layout/header',
			 'left' => 'layout/left_nav',
			 'content' => 'dashboard/content',
			 'footer' => 'layout/footer',
             );
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'2col');
        $this->hq_layout->set_data($this->data);
        $this->hq_layout->render();
    }
}    