<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {    
    
	public $data = array();
	public $image_file_name = "";
	
	public $imageData = array(				
    'alt_text' => "",
    'title_text' => "",
    'width' => "",
    'height' => "",
    'file_name'=> ""
  );
	
  public function __construct()
  {       
    parent::__construct(); 		
    $this->load->model('pages_model');		
    if(!$this->session->userdata('logged_in')){
        header('Location:/admin');
        exit;
    }        
    $this->config->set_item('menu', 'pages');		        
    $this->data['userData'] = $this->session->all_userdata();
    $this->data['segmentArray'] = $this->uri->segment_array();
    $this->output->enable_profiler(PROFILER);
  }
    
  public function index()
  {
		$lastSegment = end($this->data['segmentArray']);
		$this->load->library("pagination2");	
		$config = $this->config->load('pagination');
		$config = $this->config->config['pagination'];
		$rows_per_page = $config['per_page'];
		$pageNumber =  is_numeric($lastSegment)?$lastSegment:"1";
		$pageNumber = $rows_per_page*($pageNumber-1);
		$totalRows = $this -> pages_model -> getTotalPages();
		$config['total_rows'] = $totalRows;			
		$this->data['pages'] = $this->pages_model->getPages($pageNumber,$rows_per_page);
		$config['first_url'] = BASEURL.'/admin/pages/';
		$config['uri_segment'] = $this->uri->total_segments();	
		$config['base_url'] = BASEURL.'/admin/pages/';		
		$this->pagination2->initialize($config);
		$this->data['pagination'] = $this->pagination2->create_links();
		//echo "<pre>";print_r($this->data);exit;		
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
      'meta' => array(
        'author'=>'Mahavir Munot', 
        'viewport' => 'width=device-width, initial-scale=1.0'							
      )
    );
    $this->config->set_item('structureFile', 'structure');
    //'header','left','content','footer'
    $views=array(
      'header' => 'layout/header',
      'left' => 'layout/left_nav',
      'content' => 'pages/listing',
      'footer' => 'layout/footer',
    );
    $this->hq_layout->set_structure($structure);
    $this->hq_layout->set_layout($views,'2col');
    $this->hq_layout->set_data($this->data);
    $this->hq_layout->render();
  }
	
	public function createPage()
  {   	
		if(isset($_POST) && !empty($_POST)){			
			$pageData = array(				
				'uri' => $this->input->post('slug'),
				'head' => $this->input->post('h1_tag'),	
				'category_id' => $this->input->post('category'),
				'page_type' => 'page',
				'created_at' => date(AB_DATE_FORMAT),	
				'modified_at' => date(AB_DATE_FORMAT),
				'userid' => $this->session->userdata('id')				
				);
			$pageId = $this->pages_model->insertPage($pageData);
			if($pageId){
				$pageContentData = array(
					'page_id' => $pageId,
					'created_at' => date(AB_DATE_FORMAT),
				);
				$pageContentResponse = $this->pages_model->insertPageContent($pageContentData);
				if($pageContentResponse){
					redirect('/admin/pages', 'location', 301);
				}
			}
		}
		$this->load->model('category_model');
		$this->data['categories'] = $this->category_model->getCategorylist();		
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
			'meta' => array(
        'author'=>'Mahavir Munot', 
        'viewport' => 'width=device-width, initial-scale=1.0'							
      )
    );
		$this->config->set_item('structureFile', 'structure');
    //'header','left','content','footer'
    $views=array(
            'header' => 'layout/header',
            'left' => 'layout/left_nav',
            'content' => 'pages/create_page',
            'footer' => 'layout/footer',
          );
    $this->hq_layout->set_structure($structure);
    $this->hq_layout->set_layout($views,'2col');
    $this->hq_layout->set_data($this->data);
    $this->hq_layout->render();
  }
	
	public function seo()
  {   	
		$lastSegment = end($this->data['segmentArray']);		
		if(isset($_POST) && !empty($_POST)){
			$pageData = array(				
				'meta_title' => $this->input->post('meta_title'),
				'meta_description' => $this->input->post('meta_description'),
				'meta_keywords' => $this->input->post('meta_keywords'),
				'uri' => $this->input->post('slug'),
				'head' => $this->input->post('h1_tag'),
				'category_id' => $this->input->post('category'),							
				'modified_at' => date(AB_DATE_FORMAT)				
      );
			$is_updated = $this->pages_model->updatePageData($pageData,$lastSegment);
			if($is_updated){
				redirect('/admin/pages', 'location', 301);
			}
		}
		$select = 'p.meta_title AS meta_title, p.meta_description AS meta_description, p.meta_keywords AS meta_keywords, p.uri AS uri, p.head AS h1_tag, p.leader AS short_description, p.category_id AS category_id';
		$this->data['seoData'] = $this->pages_model->getPageData($select,$lastSegment);
		$this->load->model('category_model');
		$this->data['categories'] = $this->category_model->getCategorylist();
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
			'meta' => array(
                  'author'=>'Mahavir Munot', 
                  'viewport' => 'width=device-width, initial-scale=1.0'							
                )
    );
		$this->config->set_item('structureFile', 'structure');
    //'header','left','content','footer'
    $views=array(
      'header' => 'layout/header',
      'left' => 'layout/left_nav',
      'content' => 'pages/seo',
      'footer' => 'layout/footer',
    );
    $this->hq_layout->set_structure($structure);
    $this->hq_layout->set_layout($views,'2col');
    $this->hq_layout->set_data($this->data);
    $this->hq_layout->render();
  }

	public function do_upload()
	{	
		$oldFileName = $this->input->post('old_file_name');		
		$config = $this->config->load('upload');
		$config = $this->config->config['upload'];	
		$extension = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
		$postFileName = $this->input->post('file_name');		
		if(file_exists($config['upload_path'].DIRECTORY_SEPARATOR.$oldFileName) && !empty($oldFileName)){unlink($config['upload_path'].DIRECTORY_SEPARATOR.$oldFileName);}
		if(!empty($postFileName)){
			$config['file_name'] = url_title(strtolower($this->input->post('file_name'))).".$extension";
		}else{
			$config['file_name'] = url_title(strtolower($this->input->post('alt_text'))).".$extension";
		}
		$this->image_file_name = $config['file_name'];
		$this->load->library('upload', $config);		
		//echo "<pre>";print_r($_FILES);echo "</pre>";
		if (!$this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			//echo "<pre>";print_r($error);exit;
			return false;
		} 
    else 
    {
			
			$data = array('upload_data' => $this->upload->data());
			//echo "<pre>";print_r($data);exit;
			return true;
		}
	}
	
	public function image()
  {  		
		$this->load->library('form_validation');
		$lastSegment = end($this->data['segmentArray']);				
		//echo "<pre>";print_r($this->data['imageData']['image']);exit;
		//echo "<pre>";print_r($this->data['imageData']);exit;
		if(isset($_POST) && !empty($_POST)){
			if(!empty($_FILES['userfile']['name'])){
				if($this->do_upload()){
					$imageData = array(				
						'alt_text' => $this->input->post('alt_text'),
						'title_text' => $this->input->post('title_text'),
						'width' => $this->input->post('width'),
						'height' => $this->input->post('height'),
						'file_name'=> $this->image_file_name
					);			
					$pageData = array(
						'image' => serialize($imageData),
						'modified_at' => date(AB_DATE_FORMAT)
					);
					$is_updated = $this->pages_model->updatePageData($pageData,$lastSegment);
				}
			}
		}
		$select = 'p.id AS page_id, p.image AS image, p.head AS h1_tag,p.uri AS uri';
		$this->data['imageData'] = $this->pages_model->getPageData($select,$lastSegment);		
		if(!empty($this->data['imageData']['image'])){
			$this->data['imageData']['image'] = unserialize($this->data['imageData']['image']);
		}else{
			$this->data['imageData']['image'] =  $this->imageData;
		}
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
			'meta' => array(
        'author'=>'Mahavir Munot', 
				'viewport' => 'width=device-width, initial-scale=1.0'							
			)
    );
		$this->config->set_item('structureFile', 'structure');
    //'header','left','content','footer'
    $views=array(
      'header' => 'layout/header',
      'left' => 'layout/left_nav',
      'content' => 'pages/image',
      'footer' => 'layout/footer',
    );
    $this->hq_layout->set_structure($structure);
    $this->hq_layout->set_layout($views,'2col');
    $this->hq_layout->set_data($this->data);
    $this->hq_layout->render();
  }	
	
	public function content()
  {   	
		$lastSegment = end($this->data['segmentArray']);
		if(isset($_POST) && !empty($_POST)){
			//echo "<pre>";print_r($_POST);exit;
			$content = $this->input->post('content_textbox');
			$leader = substr(strip_tags($content),0,255);			
			$pageContentData = array(				
				'content' => $content,										
				'created_at' => date(AB_DATE_FORMAT)				
				);
			$pageData = array(				
				'leader' => $leader,										
				'modified_at' => date(AB_DATE_FORMAT)				
				);
			
			$page_content_updated = $this->pages_model->updatePageContent($pageContentData,$lastSegment);
			$page_updated = $this->pages_model->updatePageData($pageData,$lastSegment);
			
		}
		$select = 'pc.content AS content';
		$this->data['page'] = $this->pages_model->getPageData($select,$lastSegment);
		$structure = array(				
      'title' => "HTML5 - Hands on UI",
      'keywords' =>"HTML5 - Hands on UI",
      'description' => "HTML5 - Hands on UI",
      //'js' => 'backend/js/all.js,backend/js/jHtmlArea-0.7.5.js',            
			//'css' => array('backend/css/all.css','backend/css/jHtmlArea.css'),
			'js' => 'backend/js/all.js,backend/js/Markdown.Converter.js,backend/js/Markdown.Sanitizer.js,backend/js/Markdown.Editor.js',
			'css' => array('backend/css/all.css','backend/css/wmd.css'),
			'misc_head' => '<!--[if gte IE 9]><link rel="stylesheet" href="/assets/backend/css/ie9.css" type="text/css" /><![endif]-->
			<!--[if gte IE 8]><link rel="stylesheet" href="/assets/backend/css/ie8.css" type="text/css" /><![endif]-->',
			//'meta' => array('<meta charset="utf-8" />','<meta name="author" content="" />','<meta name="viewport" content="width=device-width, initial-scale=1.0">')
			/*
			'meta' => array('author'=>'Mahavir Munot', 
							'viewport' => 'width=device-width, initial-scale=1.0',
							'copyright' => 'All content and images copyright &copy; 2013, addedbits'
							)
			*/
			'meta' => array(
        'author'=>'Mahavir Munot', 
        'viewport' => 'width=device-width, initial-scale=1.0'							
      )
    );
		$this->config->set_item('structureFile', 'structure');
    //'header','left','content','footer'
    $views=array(
      'header' => 'layout/header',
      'left' => 'layout/left_nav',
      'content' => 'pages/content',
      'footer' => 'layout/footer',
    );
    $this->hq_layout->set_structure($structure);
    $this->hq_layout->set_layout($views,'2col');
    $this->hq_layout->set_data($this->data);
    $this->hq_layout->render();
  }
	
	public function delete()
  {   	
		echo "Delete";exit;
  }
	
	public function publish_unpublish()
  {   
		$id = trim(end($this->data['segmentArray']));    
    $token = $this->uri->segment(3);
    $token = !empty($token)?$token:"";    
    if($token == 'publish') {      
      $pageData = array(
        'is_published' => '1',
        'modified_at' => date(AB_DATE_FORMAT)
      );      
      $is_updated = $this->pages_model->updatePageData($pageData,$id);      
    }
    
    if($token == 'unpublish') {      
      $pageData = array(
        'is_published' => '0',
        'modified_at' => date(AB_DATE_FORMAT)
      );      
      $is_updated = $this->pages_model->updatePageData($pageData,$id);
    }        
    redirect('/admin/pages', 'refresh');
    exit;
  }
}    