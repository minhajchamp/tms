<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model
{
	public function show_setting_data()
       {
	      $this->db->select('setting_proj_title,setting_address,setting_phonenumber,setting_email,setting_logo,setting_email_from,setting_email_to');
          $this->db->from('setting');
          $query = $this->db->get();
          $result = $query->row();
          return $result;
	 
       }
	public function update($data)
	  {
		
		$this->db->update('setting',$data);
		$this->logs->create($this->db->last_query());
	  }	


}


?>
