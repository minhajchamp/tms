<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticketing_comment_model extends CI_Model
{
	public function insert($data)
	{
		if($this->db->insert('ticketing_comment',$data)){
			$this->logs->create($this->db->last_query());
			return $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	


	public function insert_batch($data)
	{
		$this->db->insert_batch('ticketing_comment',$data);
		$this->logs->create($this->db->last_query());
	}
	

	public function get_all($data = array())
    {	
      $this->db->select('*');
      $this->db->where('ticketing_comment_status','active');
	  $this->db->order_by('ticketing_comment_id', 'DESC');
      $this->db->from('ticketing_comment');
      $query = $this->db->get();
      $result = $query->result();
      return $result;
	 
    }


	public function get_all_by_ticket($id)
    {	

		$this->db->select('ticketing_comment.*,ticketing_media.filename, CONCAT(user.user_firstname, " ", user.user_lastname) as user_name');
		$this->db->where(array('ticketing_comment_status'=> 'active', 'ticketing_comment.ticketing_id' => $id));
		$this->db->join('ticketing_media', 'ticketing_comment.ticketing_media_id = ticketing_media.ticketing_media_id', 'LEFT');

		$this->db->join('user', 'ticketing_comment.user_id = user.user_id', 'LEFT');
		$this->db->order_by('ticketing_comment.ticketing_comment_id', 'ASC');
		$this->db->from('ticketing_comment as ticketing_comment');
		$query = $this->db->get();
		$result = $query->result();
		return $result;

	 
    }




	public function update($data,$id)
	{    
		$this->db->where('ticketing_comment_id',$id);
		$this->db->update('ticketing_comment',$data);
		$this->logs->create($this->db->last_query());
	}
	
	public function show_ticketing_comment_data($id)
    { 
		$this->db->select('ticketing_comment.*,ticketing_media.filename, CONCAT(user.user_firstname, " ", user.user_lastname) as user_name');

		$this->db->where(array('ticketing_comment_status'=> 'active', 'ticketing_comment.ticketing_comment_id' => $id));
		$this->db->join('ticketing_media', 'ticketing_comment.ticketing_media_id = ticketing_media.ticketing_media_id', 'LEFT');
		$this->db->join('user', 'ticketing_comment.user_id = user.user_id', 'LEFT');
		$this->db->order_by('ticketing_comment.ticketing_comment_id', 'ASC');
		$this->db->from('ticketing_comment as ticketing_comment');
		$query = $this->db->get();
		$result = $query->result();
		return $result;

    }



	public function delete($id)
	{
	    $this->db->where('ticketing_comment_id', $id);
		$this->db->update('ticketing_comment',array('ticketing_comment_status' => 'inactive'));
		$this->logs->create($this->db->last_query());
	}
	

}
?>
