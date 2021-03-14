<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campus_model extends CI_Model
{
	public function insert($data)
	{
		$this->db->insert('campus',$data);
		$this->logs->create($this->db->last_query());
	}
	


	public function insert_batch($data)
	{
		$this->db->insert_batch('campus',$data);
		$this->logs->create($this->db->last_query());
	}
	

	public function get_all()
    {
	      $this->db->select('*');
	      $this->db->where('campus_status','active');
          $this->db->from('campus');
          $query = $this->db->get();
          $result = $query->result();
          return $result;
	 
    }

	public function get_all_by_school_id($school_id = "")
	{
		$this->db->select('*');
		$this->db->where('campus_status','active');
		$this->db->where('school_id',$school_id );	

		$this->db->from('campus');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function update($data,$id)
	{    
		$this->db->where('campus_id',$id);
		$this->db->update('campus',$data);
		$this->logs->create($this->db->last_query());
	}
	
	public function show_campus_data($id)
    { 
	      $this->db->select('campus_name,campus_port_reference,campus_logo,campus_contact_no,campus_email,campus_address');
	      $this->db->where('campus_id',$id);
          $this->db->from('campus');
          $query  = $this->db->get();
          $result = $query->row();
          return $result;
    }
	public function delete($id)
	{
	    $this->db->where('campus_id', $id);
		$this->db->update('campus',array('campus_status' => 'inactive'));
		$this->logs->create($this->db->last_query());
	}
	

}
?>
