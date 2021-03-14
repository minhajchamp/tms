<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends General_controller
{
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('department_model');

	}
	
	public function index()
	{
		$data['records'] = $this->department_model->get_all();
		$data['view'] = 'department/list';
		$this->load->view('default',$data);	
		
	}
	
	public function add()
	{
		
		$data['view'] = 'department/add_department';	
		$this->load->view('default',$data);	
		
	}
	
	public function edit($id)
	{
		$data['record'] = $this->department_model->show_department_data($id);	
		$data['view'] = 'department/update_department';	
		$this->load->view('default',$data);	
	}
	
	public function insert()
	{
		if(!empty($_POST))
		{			


			$this->form_validation->set_rules('departmentdata[]','department Name','required|min_length[5]|max_length[100]');
			
			if($this->form_validation->run() == FALSE)
			{
				$data['view'] = 'department/add_department';
				$this->load->view('default',$data);
				
			}
			else
			{
				$data = array();

				foreach ($this->input->post('departmentdata') as $department) {
					$data[] = array(
						'department_name' => $department['department_name'],
						'department_status'          => 'active',
						'department_activity_by'     => $this->session->userdata('user_id')
					);
				}
				
				$this->department_model->insert_batch($data);
				$this->session->set_flashdata('success', 'Sucessfully Inserted.');
				redirect('department');
			}
		}
	}
	
	public function update($id)
	{
		if(!empty($_POST))
		{     
			
			$this->form_validation->set_rules('department_name','department Name','required|min_length[1]|max_length[100]');
			
			if($this->form_validation->run() == FALSE)
			{
				$data['view'] = 'department/update_department';
				$this->load->view('default',$data);
				
			}
			else
			{	

				$data = array(
					'department_name' => $this->input->post('department_name'),
					'department_status'          => 'active',
					'department_activity_by'     => $this->session->userdata('user_id')
				);


				$this->department_model->update($data,$id);
				$this->session->set_flashdata('success', 'Sucessfully Updated.');
				redirect('department');
			}
		}		

	}

	public function delete($id)
	{
		$this->department_model->delete($id);
		$this->session->set_flashdata('Deleted', 'Record Sucessfully Deleted.');
		redirect('department');
	}



	function file_upload(){
		if($_FILES['file']['size'] > 0){
			$image = single_image_upload($_FILES['file'],'./uploads/department');
			if(is_array($image)){            
				$this->session->set_flashdata('error', $image);
			}else{
				echo $data['file'] = $image;
			}
		}
	}	
}
?>
