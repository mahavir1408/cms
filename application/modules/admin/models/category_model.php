<?php
class category_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
	
	public function getCategory($id){
        $this->db->where('id',$id);
		$category=$this->db->get('ab_category')->result_array();
		if(isset($category) && !empty($category)){
			return current($category);
		}else{
			return false;
		}
    }
	
	public function getCategorylist($limit=null, $offset=null){ 		
		/*
		$this->db->select('c.id AS category_id, c.display_name AS display_name, c.slug AS slug, c.created_at As created_at,c.is_published AS is_published,u.name AS username');
		$this->db->from("ab_category as c");
		$this->db->join("ab_user AS u", "c.userid = u.id", "join");
		$this->db->order_by("c.id", "desc");	
		if(!empty($limit) || !empty($offset)){
			$categories=$this->db->limit($offset,$limit)->get()->result_array();
		}else{
			$categories=$this->db->get()->result_array();
		}
		//echo $this->db->last_query();		
		if(isset($categories) && !empty($categories)){
			return $categories;
		}else{
			return false;
		}
		*/
		$this->db->select('p.id AS pageid, c.id AS category_id, c.display_name AS display_name, c.slug AS slug, c.created_at As created_at,c.is_published AS is_published,u.name AS username');		
		$this->db->from("ab_page as p");
		$this->db->join("ab_category AS c", "c.id = p.category_id");
		$this->db->join("ab_page_content AS pc", "pc.page_id = p.id");
		$this->db->join("ab_user AS u", "u.id = p.userid");
		$this->db->where('p.page_type','directory');
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
	
	public function getTotalCategory(){   		
		$this->db->select('COUNT(c.id) AS total');		
		$this->db->from("ab_page as p");
		$this->db->join("ab_category AS c", "c.id = p.category_id");
		$this->db->join("ab_page_content AS pc", "pc.page_id = p.id");
		$this->db->join("ab_user AS u", "u.id = p.userid");
		$this->db->where('p.page_type','directory');
		$total=$this->db->get()->row('total');		
		if(isset($total) && !empty($total)){
			return $total;
		}else{
			return false;
		}
    }
	
	public function insert($formData) {
		$return_result=$this->db->insert('ab_category', $formData);
		if($return_result){
    		return $this->db->insert_id();
		}else{
			return false;
		}
	}
	
	public function update($formData,$id) {
		$this->db->where('id', $id);
		$return_result=$this->db->update('ab_category', $formData); 		
		if($return_result){
    		return true;
		}else{
			return false;
		}
	}
}