<?php
class pages_model extends CI_Model {
    
    public function __construct()
    {
      parent::__construct(); 
      //echo $this->db->last_query();exit;
    }    
	
	public function getPages($limit=null, $offset=null){
		$this->db->select('p.id AS pageid, c.id AS categoryid, pc.id AS page_content_id,u.id AS userid,p.head AS h1_text,p.is_published AS is_published,c.display_name AS category_name,u.name AS user_full_name');
		$this->db->from("ab_page as p");
		$this->db->join("ab_category AS c", "c.id = p.category_id", "left");
		$this->db->join("ab_page_content AS pc", "pc.page_id = p.id", "left");
		$this->db->join("ab_user AS u", "u.id = p.userid", "left");
		$this->db->where('p.page_type','page');
		if(!empty($limit) || !empty($offset)){
			$pages = $this->db->limit($offset,$limit)->order_by("modified_at", "desc")->get()->result_array();
		} else {
			$pages = $this->db->order_by("modified_at", "desc")->get()->result_array();
		}
		if(isset($pages) && !empty($pages)){
			return $pages;
		}else{
			return false;
		}
	}
	
	public function getPageData($select,$pageId){
		$this->db->select($select);
		$this->db->from("ab_page as p");
		$this->db->join("ab_page_content AS pc", "pc.page_id = p.id", "left");
		$this->db->where('p.id', $pageId);
		$pageData=current($this->db->get()->result_array());
		
		if(isset($pageData) && !empty($pageData)){
			return $pageData;
		}else{
			return false;
		}
	}
	
	public function getTotalPages(){
		$this->db->select('count(p.id) AS total');
		$this->db->from("ab_page as p");
		$this->db->join("ab_category AS c", "c.id = p.category_id", "left");
		$this->db->join("ab_page_content AS pc", "pc.page_id = p.id", "left");
		$this->db->join("ab_user AS u", "u.id = p.userid", "left");
		$this->db->where('p.page_type','page');
		$total=$this->db->get()->row('total');		
		if(isset($total) && !empty($total)){
			return $total;
		}else{
			return false;
		}
	}
	
	public function insertPage($formData) {
		$return_result=$this->db->insert('ab_page', $formData);
		if($return_result){
    		return $this->db->insert_id();
		}else{
			return false;
		}
	}
	
	public function insertPageContent($formData) {
		$return_result=$this->db->insert('ab_page_content', $formData);
		if($return_result){
    		return true;
		}else{
			return false;
		}
	}
	
	public function updatePageData($formData,$pageId){     
		$this->db->where('id', $pageId);
		$return_result=$this->db->update('ab_page', $formData);    
		if($return_result){
      return true;
		}else{
			return false;
		}
	}
	
	public function updatePageContent($formData,$pageId){
		$this->db->where('id', $pageId);
		$return_result=$this->db->update('ab_page_content', $formData); 		
		if($return_result){
    		return true;
		}else{
			return false;
		}
	}
}   