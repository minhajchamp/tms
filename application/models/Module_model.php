<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module_model extends CI_Model
{
	public function insert($data)
	{
		$this->db->insert('module',$data);
		$this->logs->create($this->db->last_query());
	}
	


	public function insert_batch($data)
	{
		$this->db->insert_batch('module',$data);
		$this->logs->create($this->db->last_query());
	}
	

	public function get_all()
    {
	      $this->db->select('*');
	      $this->db->where('module_status','active');
          $this->db->from('module');
          $query = $this->db->get();
          $result = $query->result();
          return $result;
	 
    }

	public function get_all_by_product_id($product_id = "")
	{
		$this->db->select('*');
		$this->db->where('module_status','active');
		$this->db->where('product_id',$product_id );	

		$this->db->from('module');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function update($data,$id)
	{    
		$this->db->where('module_id',$id);
		$this->db->update('module',$data);
		$this->logs->create($this->db->last_query());
	}
	
	public function show_module_data($id)
    { 
	      $this->db->select('module_name,product_id');
	      $this->db->where('module_id',$id);
          $this->db->from('module');
          $query  = $this->db->get();
          $result = $query->row();
          return $result;
    }
	public function delete($id)
	{
	    $this->db->where('module_id', $id);
		$this->db->update('module',array('module_status' => 'inactive'));
		$this->logs->create($this->db->last_query());
	}
	

}
?>
