<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{


    public function insert($data)
	{
		$this->db->insert('user',$data);
		$this->logs->create($this->db->last_query());
		return $this->db->insert_id();
	}

    public function assign_school($data)
	{
		$this->db->insert('user_school',$data);
		$this->logs->create($this->db->last_query());
		return $this->db->insert_id();
	}

	public function update_school($data,$id)
	{
		$this->db->update('user_school',$data);
		$this->db->where('user_id',$id);
		$this->logs->create($this->db->last_query());
		return $this->db->insert_id();
	}




	public function get_all()
	{
		$this->db->select('*');
		$this->db->where('user_status','active');
		$this->db->where('user_type !=','superadmin');
		$this->db->join('department', 'user.department_id = department.department_id');
		$this->db->from('user');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}


	public function get_all_school_users()
	{
		$this->db->select('*,user_school.school_id as user_school_school_id,
			user_school.campus_id as user_school_campus_id,');
		$this->db->where('user_status','active');
		$this->db->where('user_type','school');
		$this->db->join('user_school as user_school', 'user.user_id = user_school.user_id','LEFT');
		$this->db->join('school as school', 'school.school_id = user_school.school_id','LEFT');
		$this->db->join('campus as campus', 'campus.campus_id = user_school.campus_id','LEFT');
		$this->db->from('user as user');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function get_all_by_department_id($department_id = '')
	{
		$this->db->select('*');
		$this->db->where('user_status','active');
		$this->db->where('department_id',$department_id);
		$this->db->from('user as user');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}


	



	public function update($data,$id)
	{    
		$this->db->where('user_id',$id);
		$this->db->update('user',$data);
		$this->logs->create($this->db->last_query());
	}
	
	public function show_user_data($id)
    {
	      $this->db->select('*');
	      $this->db->where('user_id',$id);
          $this->db->from('user');
          $query  = $this->db->get();
          $result = $query->row();
          return $result;
    
    }

	
	public function show_school_user_data($id)
    {
	      $this->db->select('*');
	      $this->db->where('user_id',$id);
		  $this->db->join('user_school as user_school', 'user.user_id = user_school.user_id','LEFT');
		  $this->db->join('school as school', 'school.school_id = user_school.school_id','LEFT');
		  $this->db->join('campus as campus', 'campus.campus_id = user_school.campus_id','LEFT');	      
          $this->db->from('user');
          $query  = $this->db->get();
          $result = $query->row();
          return $result;
    
    }






	public function delete($id)
	{
	    $this->db->where('user_id', $id);
		$this->db->update('user',array('user_status' => 'inactive'));
		$this->logs->create($this->db->last_query());
	}
	
 
	   public function get_user_password($id)
     {
		 $this->db->select('user_password');
		 $this->db->from('user');
		 $this->db->where('user_id',$id);
		 $query = $this->db->get();
         $result = $query->row();
         return $result;
	 }
}
