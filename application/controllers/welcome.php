<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{	    
		$data = $this->cache->get('nav_parent');
		if(!$data){
			$data['test'] = array ('Inside Parent','one','two','three','four');
			$this->cache->write($data, 'nav_parent',20);
		}				
		$this->load->view('welcome_message',$data);
	}
  
  public function search()
  {
    echo "Search";exit;
  }
  
  public function page_not_found()
  {
    echo "page_not_found";exit;
  }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */