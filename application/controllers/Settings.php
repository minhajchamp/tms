<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends General_controller
{
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('setting_model');
 		
	}
	
	public function index()
	{
		
		$data['record'] = $this->setting_model->show_setting_data();
		
		$data['view'] = 'setting/setting';
		$this->load->view('default',$data);		
		
	}	
	
	public function update()
	{	
		if(!empty($_POST))
		{    
			$this->form_validation->set_rules('setting_proj_title','Project Title','required|min_length[5]|max_length[30]');
			$this->form_validation->set_rules('setting_address','Address','required|min_length[5]|max_length[20]');
			$this->form_validation->set_rules('setting_email','Email','required|valid_email');
			$this->form_validation->set_rules('setting_email_from','Email From','required|valid_email');
			$this->form_validation->set_rules('setting_email_to','Email to','required|valid_email');
			
			if($this->form_validation->run() == FALSE)
			{
				$data['view'] = 'setting/setting';
				$this->load->view('default',$data);
				
			}
			
			else
			{
				
				$data = array(
						'setting_proj_title'  => $this->input->post('setting_proj_title'),
						'setting_address'	  => $this->input->post('setting_address'),
						'setting_phonenumber' => $this->input->post('setting_phonenumber'),
						'setting_email'       => $this->input->post('setting_email'),
						'setting_logo'        => $this->input->post('setting_logo'),
						'setting_email_from'  => $this->input->post('setting_email_from'),
						'setting_email_to'    => $this->input->post('setting_email_to'),
						'setting_activity_by' => '1',
						);
						
						$this->setting_model->update($data);
			}
		}
			else
			{
				redirect('settings');
			}
	}	
}
?>
