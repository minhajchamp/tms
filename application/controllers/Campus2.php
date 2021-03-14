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
		$data['view'] = 'campus/list_campus';
		$this->load->view('default',$data);	
	}
	
	public function add($school_id = "")
	{
		$data['schoolsrecords'] = $this->school_model->show_school_data($school_id);
		$data['schools'] = $this->campus_model->get_school_name();	
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
			
				$this->form_validation->set_rules('campusdata[]','Campus Name','required|min_length[5]|max_length[50]');
			
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
							'campus_name' => $campus['campus_name'],
							'school_port_reference' => $campus['school_port_reference'],
							'school_id'              => $school_id,
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
			$this->form_validation->set_rules('campus_name','Campus Name','required|min_length[5]|max_length[50]');
			
				if($this->form_validation->run() == FALSE)
				{
					$data['view'] = 'campus/update_campus';
					$this->load->view('default',$data);
				
			    }
			    else
			    {
					
					$data = array(
						'campus_name'            => $this->input->post('campus_name'),
						'school_port_reference'  => $this->input->post('school_port_reference'),
						'campus_status'          => 'active',
						'campus_activity_by'     => $this->session->userdata('user_id')
						);
						
					$this->campus_model->update($data,$id);
					$this->session->set_flashdata('success', 'Sucessfully Updated.');
					redirect('campus/'.$school_id);
 				}
	    }		
			
    }
    
    public function delete($id,$school_id = "")
    {
		$this->campus_model->delete($id);
		$this->session->set_flashdata('Deleted', 'Record Sucessfully Deleted.');
		redirect('campus/'.$school_id);
	}
}

?>
