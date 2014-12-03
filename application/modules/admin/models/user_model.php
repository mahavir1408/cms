<?php
class User_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function login_check($email,$pass){
        $q = $this
        ->db
        ->where('email ', $email)
        ->where('passwd ', md5($pass))
        ->where('is_active ', '1')
        ->get('ab_user');
        if ( $q->num_rows == 1 ) {
            return true;
        } else {
            return false;
        }
    }
	
	
	 public function getUserDetails($email,$pass){		
		$this->db->select('a.id AS userId, a.name AS userName, a.email AS userEmail,a.last_access AS userLastAccess',false);
        $this->db->where('a.email ',$email);
		$this->db->where('a.passwd ',md5($pass));
		$this->db->where('is_active ', '1');
        $adminDetails = $this->db->get('ab_user as a')->result_array();		
        if(isset($adminDetails) && !empty($adminDetails)){
            return current($adminDetails);
        }else{
            return false;
        }
	}
}   