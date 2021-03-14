<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_profile_model extends CI_Model
{

     public function show_user_data($id)
       {
	      $this->db->select('user_username,user_firstname,user_lastname,user_email,user_phonenumber,user_address,user_password,user_profile_picture');
          $this->db->from('user');
          $this->db->where('user_id', $id);
          $query = $this->db->get();
          $result = $query->row();
          return $result;
	 
       }
     public function update($data,$id)
       {    
	      $this->db->where('user_id',$id);
	      $this->db->update('user',$data); 
        $this->logs->create($this->db->last_query());
       }
  
     public function get_user_by_email($email)
       {
	      $this->db->where('user_email',$email);
	      $this->db->from('user');
	      return $this->db->get();
       }
  
     public function get_user_password($id)
     {
		 $this->db->select('user_password');
		 $this->db->from('user');
		 $this->db->where('user_id',$id);
		 $query = $this->db->get();
     $result = $query->row();
     return $result;
	 }
}
?>
