<?php
class LoginModel extends CI_Model{
    
    public function search($useremail, $userpassword){
        $this->db->where("useremail", $useremail);
        $this->db->where("userpassword", $userpassword);
        
        return $this->db->get("user")->row_array();
    }
}