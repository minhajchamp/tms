<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campus extends General_controller
{
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('campus_model');	
		$this->load->model('school_model');	
		
	}
	
	public function index($school_id = "")
	{
		$data['schoolsrecords'] = $this->school_model->show_school_data($school_id);
		$data['records'] = $this->campus_model->get_all_by_school_id($school_id);
		$data['view'] = 'campus/list';
		$this->load->view('default',$data);	
		
	}
	
	public function add($school_id = "")
	{
		$data['schoolsrecords'] = $this->school_model->show_school_data($school_id);	
		$data['view'] = 'campus/add_campus';	
		$this->load->view('default',$data);	
		
	}
	
	public function edit($id)
	{
		$data['record'] = $this->campus_model->show_campus_data($id);	
		$data['view'] = 'campus/update_campus';	
		$this->load->view('default',$data);	
	}
	
	public function insert($school_id = "")
	{
		if(!empty($_POST))
		{			

			$this->form_validation->set_rules('campusdata[]','campus Name','required|min_length[5]|max_length[100]');
			
			if($this->form_validation->run() == FALSE)
			{
				$data['view'] = 'campus/add_campus';
				$this->load->view('default',$data);
				
			}
			else
			{
				$data = array();

				foreach ($this->input->post('campusdata') as $campus) {
					$data[] = array(
						'school_id' => $school_id,
						'campus_name' => $campus['campus_name'],
						'campus_port_reference' => $campus['campus_port_reference'],
						'campus_logo' => $campus['campus_logo'],
						'campus_contact_no' => $campus['campus_contact_no'],
						'campus_email' => $campus['campus_email'],
						'campus_address' => $campus['campus_address'],
						'campus_status'          => 'active',
						'campus_activity_by'     => $this->session->userdata('user_id')
					);
				}
				
				$this->campus_model->insert_batch($data);
				$this->session->set_flashdata('success', 'Sucessfully Inserted.');
				redirect('campus/'.$school_id);
			}
		}
	}
	
	public function update($id, $school_id = "")
	{
		if(!empty($_POST))
		{     
			
			$this->form_validation->set_rules('campus_name','campus Name','required|min_length[1]|max_length[100]');
			
			if($this->form_validation->run() == FALSE)
			{
				$data['view'] = 'campus/update_campus';
				$this->load->view('default',$data);
				
			}
			else
			{	

				$data = array(
					'campus_name' => $this->input->post('campus_name'),
					'campus_port_reference' => $this->input->post('campus_port_reference'),
					'campus_logo' => $this->input->post('campus_logo'),
					'campus_contact_no' => $this->input->post('campus_contact_no'),
					'campus_email' => $this->input->post('campus_email'),
					'campus_address' => $this->input->post('campus_address'),
					'campus_status'          => 'active',
					'campus_activity_by'     => $this->session->userdata('user_id')
				);


				$this->campus_model->update($data,$id);
				$this->session->set_flashdata('success', 'Sucessfully Updated.');
				redirect('campus/'.$school_id);
			}
		}		

	}

	public function delete($id, $school_id = "")
	{
		$this->campus_model->delete($id);
		$this->session->set_flashdata('Deleted', 'Record Sucessfully Deleted.');
		redirect('campus/'.$school_id);
	}



	function file_upload(){
		if($_FILES['file']['size'] > 0){
			$image = single_image_upload($_FILES['file'],'./uploads/campus');
			if(is_array($image)){            
				$this->session->set_flashdata('error', $image);
			}else{
				echo $data['file'] = $image;
			}
		}
	}	
}
?>
