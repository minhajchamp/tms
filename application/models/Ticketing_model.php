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

	public function total_completed_count_today(){
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
		$this->db->where('ticketing_current_status', '5');
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
		if($this->userdata->user_type == 'admin' || $this->userdata->user_type == 'user'){	
			$this->db->where('department_id',$department_id );
		}

		$this->db->group_by('ticketing_current_status.ticketing_current_status_id');
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
			->or_like('school.school_name',$data['search'])
			->or_like('ticketing.ticketing_titile',$data['search'])
			->or_like('school.school_port_reference',$data['search'])
			->or_like('campus.campus_name',$data['search'])
			->or_like('campus.campus_port_reference',$data['search'])
			->or_like('product.product_name',$data['search'])
			->or_like('module.module_name',$data['search'])
			->group_end();
		}

		if(!empty($data['limit']) && !empty($data['offset'])){
			$this->db->limit($data['limit'],$data['offset']);
		}	

		if(!empty($data['ticketing_current_status']) && !empty($data['ticketing_current_status'])){
			if($data['ticketing_current_status'] == 'today'){
				$this->db->where('ticketing_activity_at >= CURDATE()');
			}
			if($data['ticketing_current_status'] == 'completedtoday'){
				$this->db->where('ticketing_activity_at >= CURDATE()');
				$this->db->where('ticketing_current_status','5');
			}else{
				$this->db->where('ticketing_current_status',$data['ticketing_current_status']);
			}
		}				  

		$this->db->select('
			ticketing.ticketing_id, 
			ticketing.generated_by_user_id,
			ticketing.assigned_to_user_id, 
			ticketing.assigned_by_user_id, 
			ticketing.preferred_user_id, 
			ticketing.ticketing_titile, 
			ticketing.generated_by_department_id, 
			ticketing.assigned_to_department_id, 
			ticketing.school_id, 
			ticketing.campus_id, 
			ticketing.product_id, 
			ticketing.module_id, 
			ticketing.ticketing_min_resolve_time, 
			ticketing.ticketing_max_resolve_time, 
			ticketing.ticketing_query, 
			ticketing.resolved_time, 
			ticketing.verified_user_id, 
			ticketing.verfied_at, 
			ticketing.updated_client_at, 
			ticketing.updated_client_by, 
			ticketing.representative_id, 
			ticketing.ticketing_status, 
			ticketing.ticketing_activity_by, 
			ticketing.ticketing_activity_at, 
			ticketing.assigned_to_user_at,

			school.school_name as school_name,
			school.school_port_reference as school_port_reference,

			campus.campus_name as campus_name,
			campus.campus_port_reference as campus_port_reference,

			product.product_name as product_name,
			module.module_name as module_name,	      	

			CONCAT(generated_by_user.user_firstname, " " , generated_by_user.user_lastname) as generated_by_user_name,
			CONCAT(assigned_to_user.user_firstname, " " , assigned_to_user.user_lastname) as assigned_to_user_name,
			CONCAT(assigned_by_user.user_firstname, " " , assigned_by_user.user_lastname) as assigned_by_user_name,
			CONCAT(preferred_user.user_firstname, " " , preferred_user.user_lastname) as preferred_user_name,
			CONCAT(verified_user.user_firstname, " " , verified_user.user_lastname) as verified_user_name,
			CONCAT(user_school.user_firstname, " " , user_school.user_lastname) as user_school_name,

			priority.priority_text as priority,
			REPLACE(query_type.query_type_text,"_"," ") as ticketing_query_type,
			query_generated_by.query_generated_by_text as query_generated_by,

			ticketing_current_status.ticketing_current_status_text as ticketing_current_status,
			ticketing_current_status.ticketing_current_status_name as ticketing_current_status_name,

			assigned_to_department.department_name as assigned_to_department_name,
			generated_by_department.department_name as generated_by_department_name
			
		');

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

          //DEPARTMENTS
		$this->db->join('department as assigned_to_department', 'ticketing.assigned_to_department_id = assigned_to_department.department_id','LEFT');
		$this->db->join('department as generated_by_department', 'ticketing.generated_by_department_id = generated_by_department.department_id','LEFT');


		  //USERS
		$this->db->join('user as generated_by_user', 'ticketing.generated_by_user_id = generated_by_user.user_id','LEFT');
		$this->db->join('user as assigned_to_user', 'ticketing.assigned_to_user_id = assigned_to_user.user_id','LEFT');
		$this->db->join('user as assigned_by_user', 'ticketing.assigned_by_user_id = assigned_by_user.user_id','LEFT');
		$this->db->join('user as preferred_user', 'ticketing.preferred_user_id = preferred_user.user_id','LEFT');
		$this->db->join('user as verified_user', 'ticketing.verified_user_id = verified_user.user_id','LEFT');
		$this->db->join('user as user_school', 'ticketing.user_school_id = user_school.user_id','LEFT');		


		$this->db->join('school as school', 'ticketing.school_id = school.school_id','LEFT');
		$this->db->join('campus as campus', 'ticketing.campus_id = campus.campus_id','LEFT');
		$this->db->join('product as product', 'ticketing.product_id = product.product_id','LEFT');
		$this->db->join('module as module', 'ticketing.module_id = module.module_id','LEFT');


		$this->db->join('query_generated_by as query_generated_by', 'ticketing.query_generated_by_id = query_generated_by.query_generated_by_id','LEFT');
		$this->db->join('query_type as query_type', 'ticketing.query_type_id = query_type.query_type_id','LEFT');
		$this->db->join('priority as priority', 'ticketing.priority_id = priority.priority_id','LEFT');
		$this->db->join('ticketing_current_status as ticketing_current_status', 'ticketing.ticketing_current_status = ticketing_current_status.ticketing_current_status_id','LEFT');



		$this->db->where('ticketing_status','active');
		$this->db->order_by('ticketing_id','DESC');
		$this->db->from('ticketing as ticketing');

		$query = $this->db->get();          
		if(!empty($data['id'])){
			$result = $query->row();
		}
		else{
			$result = $query->result();
		}
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
