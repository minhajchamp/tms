<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticketing_media_model extends CI_Model
{
	public function insert($data)
	{
		if($this->db->insert('ticketing_media',$data)){
			$this->logs->create($this->db->last_query());
			return $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	


	public function insert_batch($data)
	{
		$this->db->insert_batch('ticketing_media',$data);
		$this->logs->create($this->db->last_query());
	}
	

	public function get_all($data = array())
    {	
      $this->db->select('*');
      $this->db->where('ticketing_media_status','active');
	  $this->db->order_by('ticketing_media_id', 'DESC');
      $this->db->from('ticketing_media');
      $query = $this->db->get();
      $result = $query->result();
      return $result;
	 
    }


	public function get_all_by_ticket($id)
    {	
      $this->db->select('*');
      $this->db->where(array('ticketing_media_status'=>'active', 'ticketing_id' => $id));
	  $this->db->order_by('ticketing_media_id', 'DESC');
      $this->db->from('ticketing_media');
      $query = $this->db->get();
      $result = $query->result();
      return $result;
	 
    }




	public function update($data,$id)
	{    
		$this->db->where('ticketing_media_id',$id);
		$this->db->update('ticketing_media',$data);
		$this->logs->create($this->db->last_query());
	}
	
	public function show_ticketing_media_data($id)
    { 
	      $this->db->select('*');
	      $this->db->where('ticketing_media_id',$id);
          $this->db->from('ticketing_media');
          $query  = $this->db->get();
          $result = $query->row();
          return $result;
    }
	public function delete($id)
	{
	    $this->db->where('ticketing_media_id', $id);
		$this->db->update('ticketing_media',array('ticketing_media_status' => 'inactive'));
		$this->logs->create($this->db->last_query());
	}
	

}
?>
