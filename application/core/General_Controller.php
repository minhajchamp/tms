<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class General_controller extends CI_Controller{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('ticketing_model');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if($this->session->userdata('login') != 'active'){		
			$login_access=array('login','forget-password','reset-password');
			if(!in_array($this->uri->segment(1),$login_access))
			{
				redirect('login');
			}
		}	
		
		$this->userdata = $this->user_model->show_user_data($this->session->userdata('user_id'));
		$this->usercount = array();
		if(!empty($this->userdata)){
			$this->userstatuses = $this->ticketing_model->get_user_statuses($this->userdata->department_id);
			if(!empty($this->userstatuses)){
				foreach ($this->userstatuses as $userstatus) {
					$this->usercount[$userstatus->ticketing_current_status_id] = count($this->ticketing_model->total_count_status($userstatus->ticketing_current_status_id));
				}
			}
		}

		

		$modules = json_decode($this->session->userdata('modules'));
		$user_modules = json_decode($this->session->userdata('user_module'));

		if(!empty($this->session->userdata('user_id'))){
			$user_assigned_module = array(
				'logout' => array('user_module_read' => ''),
				'dashboard' => array('user_module_read' => ''),
				'login' => array('user_module_read' => ''),
				'user-profile' => array('user_module_read' => ''),
				'user_profile' => array('user_module_read' => ''),
				'notifications' => array('user_module_read' => ''),
			);


			foreach($user_modules as $user_module){
				$user_assigned_module[$user_module->modules_slug] = array(
					'user_module_create' => $user_module->user_module_create,
					'user_module_update' => $user_module->user_module_update,
					'user_module_read' => $user_module->user_module_read,
					'user_module_delete' => $user_module->user_module_delete,
				);
			}

			$slug = $this->uri->segment(1);
			$slug_2 = $this->uri->segment(2);
			if(array_key_exists($slug, $user_assigned_module)){

				if($slug_2 == '' && $slug != 'login' && $slug != 'logout' && $slug != 'user-profile' && $slug != 'notifications'){
					if($user_assigned_module[$slug]['user_module_read'] == 1){

					}
					else{
						$this->session->set_flashdata('error', 'You dont have permision to perform this operation.');
						redirect('');
					}
				}

				if($slug_2 == 'edit'){
					if($user_assigned_module[$slug]['user_module_update'] == 1){

					}
					else{
						$this->session->set_flashdata('error', 'You dont have permision to perform this operation.');
						redirect($slug);
					}
				}

				if($slug_2 == 'add'){
					if($user_assigned_module[$slug]['user_module_create'] == 1){

					}
					else{
						$this->session->set_flashdata('error', 'You dont have permision to perform this operation.');
						redirect($slug);
					}
				}

				if($slug_2 == 'delete'){
					if($user_assigned_module[$slug]['user_module_delete'] == 1){

					}
					else{
						$this->session->set_flashdata('error', 'You dont have permision to perform this operation.');
						redirect($slug);
					}
				}								
			}
			else{
				redirect('');
			}
		}
				

		
	}
}
?>
