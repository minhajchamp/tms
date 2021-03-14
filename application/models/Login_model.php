<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Login_model extends CI_Model
{

 public function get_user_by_email($email)
 {	 
	$this->db->where('user_email',$email);
	$this->db->where('user_status','active');
	$this->db->from('user');
	$query = $this->db->get();
	return $query->row();
 }
 
 public function update_forgettoken($email_forget_pass,$set_forgettokken)
 {  
	
  	 $this->db->where('user_email',$email_forget_pass);
	 $this->db->update('user',array('user_forgettoken' => $set_forgettokken ));
	 $this->logs->create($this->db->last_query()); 
	 
 }
 
 public function update_resetpass($confirmpassword,$set_forgettokken)
 {
	 $this->db->where('user_forgettoken',$set_forgettokken);
	 $this->db->update('user',array('user_password' => $confirmpassword, 'user_forgettoken' => ''));
	 $this->logs->create($this->db->last_query());
 }

}

?>
