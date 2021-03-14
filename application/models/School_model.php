<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School_model extends CI_Model
{
	public function insert($data)
	{
		$this->db->insert('school',$data);
		$this->logs->create($this->db->last_query());
	}
	


	public function insert_batch($data)
	{
		$this->db->insert_batch('school',$data);
		$this->logs->create($this->db->last_query());
	}
	

	public function get_all()
    {
	      $this->db->select('*');
	      $this->db->where('school_status','active');
          $this->db->from('school');
          $query = $this->db->get();
          $result = $query->result();
          return $result;
	 
    }
	public function update($data,$id)
	{    
		$this->db->where('school_id',$id);
		$this->db->update('school',$data);
		$this->logs->create($this->db->last_query());
	}
	
	public function show_school_data($id)
    {
	      $this->db->select('school_name,school_port_reference,school_logo,school_contact_no,school_email,school_address');
	      $this->db->where('school_id',$id);
          $this->db->from('school');
          $query  = $this->db->get();
          $result = $query->row();
          return $result;
    }
	public function delete($id)
	{
	    $this->db->where('school_id', $id);
		$this->db->update('school',array('school_status' => 'inactive'));
		$this->logs->create($this->db->last_query());
	}
	

}
?>
