<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model
{
	public function insert($data)
	{
		$this->db->insert('notification',$data);
		$this->logs->create($this->db->last_query());
	}
	
	public function insert_batch($data)
	{	
		$this->db->insert_batch('notification',$data);
		$this->logs->create($this->db->last_query());
	}
	

	public function get_all($data)
    {
	      $this->db->select('*');

		  if(!empty($data['limit'])) {

		  	$offset = 0;

		  	if(!empty($data['offset'])){
		  		$offset = $data['offset'];
		  	}

		  	$this->db->limit($data['limit'], $offset);
		  }		


	      $this->db->where('notification_status','active');
	      $this->db->join('ticketing','ticketing.ticketing_id = notification.ticketing_id','left');
	      $this->db->where('user_id',$data['id']);
	      $this->db->order_by('notification_id','DESC');
	      $this->db->order_by('notification_read_status','ASC');
          $this->db->from('notification');
          $query = $this->db->get();
          $result = $query->result();
          return $result;
	 
    }

    public function count($id){
		$this->db->select('count(*) as count');
		$this->db->where(array('notification_status'=>'active','notification_read_status'=>'unread'));
		$this->db->where('user_id',$id);
		$this->db->from('notification');
		$query = $this->db->get();
		$result = $query->result();
		return $result;    	
    }

	public function update($data,$id)
	{    
		$this->db->where('notification_id',$id);
		$this->db->update('notification',$data);		
		$this->logs->create($this->db->last_query());
	}

	public function update_by_ticket($data,$ticket_id)
	{    
		$this->db->where('ticketing_id',$ticket_id);
		$this->db->where('user_id',$this->userdata->user_id);
		$this->db->update('notification',$data);		
		$this->logs->create($this->db->last_query());
	}

	
	public function delete($id)
	{
	    $this->db->where('notification_id', $id);
		$this->db->update('notification',array('notification_status' => 'inactive'));
		$this->logs->create($this->db->last_query());
	}
	


	public function get_notification_users_by_ticket($ticket_id = ""){

		$notification_users = array();
		$this->db->select('
			generated_by_user_id,assigned_to_user_id,assigned_by_user_id,
			generated_by_department_id,assigned_to_department_id
		');
		$this->db->where('ticketing_id',$ticket_id);
		$this->db->from('ticketing');
		$ticket_users = $this->db->get()->row();


		foreach($ticket_users as $key => $ticket_user){
			if($key != 'generated_by_department_id' && $key != 'assigned_to_department_id'){
				if(!in_array($ticket_user, $notification_users)){
					if(!empty($ticket_user) && $ticket_user != $this->userdata->user_id){
						$notification_users[] = $ticket_user;
					}
				}
			}
		}


		$this->db->select('user_id');
		$this->db->where('user_status','active');
		$this->db->where('user_type','admin');
		$this->db->where('department_id',$ticket_users->generated_by_department_id);
		$this->db->from('user');
		$generated_by_user_admins = $this->db->get()->result_array();

		$this->db->select('user_id');
		$this->db->where('user_status','active');
		$this->db->where('user_type','admin');
		$this->db->where('department_id',$ticket_users->assigned_to_department_id);
		$this->db->from('user');
		$assigned_by_user_admins = $this->db->get()->result_array();		

		foreach($generated_by_user_admins as $user_admin){
			if(!in_array($user_admin['user_id'], $notification_users)){
				if(!empty($user_admin['user_id']) && $user_admin['user_id'] != $this->userdata->user_id){
					$notification_users[] = $user_admin['user_id'];
				}
			}
		}

		$user_admin = '';
		foreach($assigned_by_user_admins as $user_admin){
			if(!in_array($user_admin['user_id'], $notification_users)){
				if(!empty($user_admin['user_id']) && $user_admin['user_id'] != $this->userdata->user_id){
					$notification_users[] = $user_admin['user_id'];
				}
			}
		}		
		
		return $notification_users;
	}

}
?>
