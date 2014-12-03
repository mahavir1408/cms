<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {    
    
	public $data = array();
	
    public function __construct()
    {       
        parent::__construct(); 		
        $this->load->model('blog_model');		
        if(!$this->session->userdata('logged_in')){
            header('Location:/admin');
            exit;
        }        
        $this->config->set_item('menu', 'blog');	
		$this->data['userData'] = $this->session->all_userdata();
    }
    
    public function index()
    {        
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
             'header' => 'layout/header',
			 'left' => 'layout/left_nav',
			 'content' => 'blog/blog',
			 'footer' => 'layout/footer',
             );
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'2col');
        $this->hq_layout->set_data($this->data);
        $this->hq_layout->render();
    }
	
	public function add()
    {   		
		$this->load->model('category_model');
		$this->data['categories']=$this->category_model->getCategoryList();
		//echo "<pre>";print_r($this->data['categories']);exit;
		$this->insertBlogData();
        $structure = array(				
            'title' => "HTML5 - Hands on UI",
            'keywords' =>"HTML5 - Hands on UI",
            'description' => "HTML5 - Hands on UI",
            'js' => 'backend/js/all.js,backend/js/jHtmlArea-0.7.5.js',
            'css' => array('backend/css/all.css','backend/css/jHtmlArea.css'),
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
			 'content' => 'blog/add',
			 'footer' => 'layout/footer',
             );
        $this->hq_layout->set_structure($structure);
        $this->hq_layout->set_layout($views,'2col');
        $this->hq_layout->set_data($this->data);
        $this->hq_layout->render();
    }
	
	private function insertBlogData(){
		if(isset($_POST) && !empty($_POST)){
			
			$this->load->helper('generic');				
			if(isset($_FILES['blogImage']) && !empty($_FILES['blogImage']['name'])){		
				$img['blog']=uploadImage($_FILES['blogImage']);
			}
			//$postData = $this->input->post();
			//$string = $_POST['blog_content'];
			//if(get_magic_quotes_gpc())  // prevents duplicate backslashes
			//$string = stripslashes($string);
			$string = htmlentities($this->input->post('blog_content'));
			//$string = str_replace(array("&lt;pre&gt;", "&lt;/pre&gt;", "&lt;code&gt;", "&lt;/code&gt;"), array("<pre>", "</pre>", "<code>", "</code>"), $string);
			//echo "<br />";
			//echo "<pre>";print_r($postData);
			//echo html_entity_decode($this->input->post('blog_content'));
			echo $string;
			exit;
		}
	}
}    