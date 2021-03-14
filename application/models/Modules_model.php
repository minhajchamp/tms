<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modules_model extends CI_Model
{

	public function insert_batch($data)
	{
		$this->db->insert_batch('user_module',$data);
		$this->logs->create($this->db->last_query());
		return $this->db->insert_id();
	}

	public function get_all()
    {
	      $this->db->select('*');
	      $this->db->where('modules_status','active');
          $this->db->from('modules');
          $query = $this->db->get();
          $result = $query->result();
          return $result;
	 
    }

	public function get_all_by_user_id($user_id = "")
	{
		$this->db->select('*');
		$this->db->where('user_id',$user_id);
		$this->db->join('modules','user_module.module_id = modules.modules_id','LEFT');
		$this->db->from('user_module');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
}
?>
