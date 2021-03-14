<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School extends General_controller
{
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('school_model');

	}
	
	public function index()
	{
		$data['records'] = $this->school_model->get_all();
		$data['view'] = 'school/list';
		$this->load->view('default',$data);	
		
	}
	
	public function add()
	{
		
		$data['view'] = 'school/add_school';	
		$this->load->view('default',$data);	
		
	}
	
	public function edit($id)
	{
		$data['record'] = $this->school_model->show_school_data($id);	
		$data['view'] = 'school/update_school';	
		$this->load->view('default',$data);	
	}
	
	public function insert()
	{
		if(!empty($_POST))
		{			


			$this->form_validation->set_rules('schooldata[]','School Name','required|min_length[5]|max_length[100]');
			
			if($this->form_validation->run() == FALSE)
			{
				$data['view'] = 'school/add_school';
				$this->load->view('default',$data);
				
			}
			else
			{
				$data = array();

				foreach ($this->input->post('schooldata') as $school) {
					$data[] = array(
						'school_name' => $school['school_name'],
						'school_port_reference' => $school['school_port_reference'],
						'school_logo' => $school['school_logo'],
						'school_contact_no' => $school['school_contact_no'],
						'school_email' => $school['school_email'],
						'school_address' => $school['school_address'],
						'school_status'          => 'active',
						'school_activity_by'     => $this->session->userdata('user_id')
					);
				}
				
				$this->school_model->insert_batch($data);
				$this->session->set_flashdata('success', 'Sucessfully Inserted.');
				redirect('school');
			}
		}
	}
	
	public function update($id)
	{
		if(!empty($_POST))
		{     
			
			$this->form_validation->set_rules('school_name','School Name','required|min_length[1]|max_length[100]');
			
			if($this->form_validation->run() == FALSE)
			{
				$data['view'] = 'school/update_school';
				$this->load->view('default',$data);
				
			}
			else
			{	

				$data = array(
					'school_name' => $this->input->post('school_name'),
					'school_port_reference' => $this->input->post('school_port_reference'),
					'school_logo' => $this->input->post('school_logo'),
					'school_contact_no' => $this->input->post('school_contact_no'),
					'school_email' => $this->input->post('school_email'),
					'school_address' => $this->input->post('school_address'),
					'school_status'          => 'active',
					'school_activity_by'     => $this->session->userdata('user_id')
				);


				$this->school_model->update($data,$id);
				$this->session->set_flashdata('success', 'Sucessfully Updated.');
				redirect('school');
			}
		}		

	}

	public function delete($id)
	{
		$this->school_model->delete($id);
		$this->session->set_flashdata('Deleted', 'Record Sucessfully Deleted.');
		redirect('school');
	}



	function file_upload(){
		if($_FILES['file']['size'] > 0){
			$image = single_image_upload($_FILES['file'],'./uploads/school');
			if(is_array($image)){            
				$this->session->set_flashdata('error', $image);
			}else{
				echo $data['file'] = $image;
			}
		}
	}	
}
?>
