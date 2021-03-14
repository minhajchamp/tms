<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department_model extends CI_Model
{
	public function insert($data)
	{
		$this->db->insert('department',$data);
		$this->logs->create($this->db->last_query());
	}
	


	public function insert_batch($data)
	{
		$this->db->insert_batch('department',$data);
		$this->logs->create($this->db->last_query());
	}
	

	public function get_all()
    {
	      $this->db->select('*');
	      $this->db->where('department_status','active');
          $this->db->from('department');
          $query = $this->db->get();
          $result = $query->result();
          return $result;
	 
    }
	public function update($data,$id)
	{    
		$this->db->where('department_id',$id);
		$this->db->update('department',$data);
		$this->logs->create($this->db->last_query());
	}
	
	public function show_department_data($id)
    {
	      $this->db->select('department_name');
	      $this->db->where('department_id',$id);
          $this->db->from('department');
          $query  = $this->db->get();
          $result = $query->row();
          return $result;
    }
	public function delete($id)
	{
	    $this->db->where('department_id', $id);
		$this->db->update('department',array('department_status' => 'inactive'));
		$this->logs->create($this->db->last_query());
	}
	

}
?>
