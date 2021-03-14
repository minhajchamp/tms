<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticketing_model extends CI_Model
{
	public function insert($data)
	{
		if($this->db->insert('ticketing',$data)){
			$this->logs->create($this->db->last_query());
			return $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	
	public function total_count(){
		if($this->userdata->user_type == 'admin'){	
			$this->db->group_start();  	
			$this->db->where('generated_by_department_id',$this->userdata->department_id);
			$this->db->or_where('assigned_to_department_id',$this->userdata->department_id);
			$this->db->group_end();
		}
		else if($this->userdata->user_type == 'user'){
			$this->db->group_start();  	
			$this->db->where('generated_by_user_id',$this->userdata->user_id);	
			$this->db->or_where('assigned_to_user_id',$this->userdata->user_id);
			$this->db->group_end();
		}
		$this->db->from('ticketing');
		$this->db->where('ticketing_status','active');

		$query = $this->db->get();          
		$result = $query->result();
		return $result;
	}

	public function total_count_today(){
		if($this->userdata->user_type == 'admin'){	
			$this->db->group_start();  	
			$this->db->where('generated_by_department_id',$this->userdata->department_id);
			$this->db->or_where('assigned_to_department_id',$this->userdata->department_id);
			$this->db->group_end();
		}
		else if($this->userdata->user_type == 'user'){
			$this->db->group_start();  	
			$this->db->where('generated_by_user_id',$this->userdata->user_id);	
			$this->db->or_where('assigned_to_user_id',$this->userdata->user_id);
			$this->db->group_end();
		}
		$this->db->from('ticketing');
		$this->db->where('ticketing_status','active');
		$this->db->where('ticketing_activity_at >= CURDATE()');

		$query = $this->db->get();          
		$result = $query->result();
		return $result;
	}

	public function total_count_status($status_id){
		if($this->userdata->user_type == 'admin'){	
			$this->db->group_start();  	
			$this->db->where('generated_by_department_id',$this->userdata->department_id);
			$this->db->or_where('assigned_to_department_id',$this->userdata->department_id);
			$this->db->group_end();
		}
		else if($this->userdata->user_type == 'user'){
			$this->db->group_start();  	
			$this->db->where('generated_by_user_id',$this->userdata->user_id);	
			$this->db->or_where('assigned_to_user_id',$this->userdata->user_id);
			$this->db->group_end();
		}
		$this->db->from('ticketing');
		$this->db->where('ticketing_status','active');
		$this->db->where('ticketing_current_status',$status_id);

		$query = $this->db->get();          
		$result = $query->result();
		return $result;
	}


	public function insert_batch($data)
	{
		$this->db->insert_batch('ticketing',$data);
		$this->logs->create($this->db->last_query());
	}
	

	public function get_dropdowns()
	{
		$dropdowns = array();

		$this->db->from('priority');
		$this->db->where('priority_status','active');
		$query = $this->db->get();          
		$dropdowns['priority'] = $query->result();

		$this->db->from('query_type');
		$this->db->where('query_type_status','active');
		$query = $this->db->get();          
		$dropdowns['query_type'] = $query->result();

		$this->db->from('query_generated_by');
		$this->db->where('query_generated_by_status','active');
		$query = $this->db->get();          
		$dropdowns['query_generated_by'] = $query->result();		


		return $dropdowns;



	}	

	public function get_user_statuses($department_id =""){
		$this->db->from('department_status');

		$this->db->join('ticketing_current_status','ticketing_current_status.ticketing_current_status_id = department_status.ticketing_current_status_id','LEFT');	
		$this->db->where('department_id',$department_id );
		$this->db->where('department_status.department_status_status','active');
		$this->db->where('ticketing_current_status.ticketing_current_status_status','active');

		
		$query = $this->db->get();          
		$result = $query->result();
		return $result;
	}

	public function get_all($data = array())
	{	
		if(!empty($data['limit'])){
			$this->db->limit($data['limit']);
		}

		if(!empty($data['search'])){
			$this->db->group_start()
			->or_like('school_name',$data['search'])
			->or_like('ticketing_titile',$data['search'])
			->or_like('school_port_reference',$data['search'])
			->or_like('campus_name',$data['search'])
			->or_like('campus_port_reference',$data['search'])
			->or_like('product_name',$data['search'])
			->or_like('module_name',$data['search'])
			->group_end();
		}

		if(!empty($data['limit']) && !empty($data['offset'])){
			$this->db->limit($data['limit'],$data['offset']);
		}	

		if(!empty($data['ticketing_current_status']) && !empty($data['ticketing_current_status'])){
			if($data['ticketing_current_status'] == 'today'){
				$this->db->where('ticketing_activity_at >= CURDATE()');
			}else{
				$this->db->where('ticketing_current_status',$data['ticketing_current_status']);
			}
		}				  

		if(!empty($data['id'])){
			$this->db->where('ticketing_id',$data['id']);
		}else{
			if($this->userdata->user_type == 'admin'){	
				$this->db->group_start();  	
				$this->db->where('generated_by_department_id',$this->userdata->department_id);
				$this->db->or_where('assigned_to_department_id',$this->userdata->department_id);
				$this->db->group_end();
			}
			else if($this->userdata->user_type == 'user'){
				$this->db->group_start();  	
				$this->db->where('generated_by_user_id',$this->userdata->user_id);	
				$this->db->or_where('assigned_to_user_id',$this->userdata->user_id);
				$this->db->group_end();
			}
		}


		$this->db->where('ticketing_status','active');
		$this->db->order_by('ticketing_id','DESC');
		$this->db->from('ticketing_all as ticketing_all');

		$query = $this->db->get();          
		if(!empty($data['id'])){
			$result = $query->row();
		}
		else{
			$result = $query->result();
		}
		//echo $this->db->last_query();
		return $result;

	}


	public function update($data,$id)
	{    
		$this->db->where('ticketing_id',$id);
		if($this->db->update('ticketing',$data)){
			$this->logs->create($this->db->last_query());
			return true;
		}else{
			return false;	
		}
	}
	

	public function delete($id)
	{
		$this->db->where('ticketing_id', $id);
		$this->db->update('ticketing',array('ticketing_status' => 'inactive'));
		$this->logs->create($this->db->last_query());
	}
	

}
?>
