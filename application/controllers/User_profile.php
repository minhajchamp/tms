<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_profile extends General_controller
{
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('user_profile_model');
		$this->load->library('encryption');	
		$this->load->helper('email');
	}
	
	public function index()
	{   
		$id = $this->session->userdata('user_id');
		$data['record'] = $this->user_profile_model->show_user_data($id);
		
		$data['view'] = 'userprofile/userprofile';
		$this->load->view('default',$data);		
	}
	
	public function update()
	{
		if(!empty($_POST))
		{
			
			$this->form_validation->set_rules('user_username','UserName','required|min_length[5]|max_length[20]');
			$this->form_validation->set_rules('user_firstname','FirstName','required|min_length[2]');
			$this->form_validation->set_rules('user_lastname','LastName','required|min_length[2]|max_length[20]');
			$this->form_validation->set_rules('user_email','Email','required|valid_email');
			$this->form_validation->set_rules('user_password','CurrentPassword','min_length[8]|max_length[20]|callback_check_password');
			$this->form_validation->set_rules('newpassword','NewPassword','min_length[8]|max_length[20]');
			$this->form_validation->set_rules('confirm_newpassword','ConfirmNewPassword','matches[newpassword]');
			

			if($this->form_validation->run() == FALSE)
			{
				$data['view'] = 'userprofile/userprofile';
				$this->load->view('default',$data);
				
			}
			else
			{	

				if(!empty($this->input->post('user_profile_picture',true))){
					$data['user_profile_picture'] = $this->input->post('user_profile_picture',true);
				} 

				$current_pass = $this->input->post('user_password',true); 
				$new_pass  = $this->input->post('newpassword',true); 
				$confirm_pass = $this->input->post('confirm_newpassword',true);

				$data['user_username']    = $this->input->post('user_username',true);
				$data['user_firstname']   = $this->input->post('user_firstname',true);
				$data['user_lastname']    = $this->input->post('user_lastname',true);
				$data['user_email']       = $this->input->post('user_email',true);
				$data['user_phonenumber'] = $this->input->post('user_phonenumber',true);
				$data['user_address']     = $this->input->post('user_address',true);
				$data['user_activity_by'] = '1';
				if(!empty($current_pass) && !empty($new_pass) && !empty($confirm_pass))
				{

					$data['user_password'] = $this->encryption->encrypt($this->input->post('confirm_newpassword'));

				}
				$id = $this->session->userdata('user_id');	


				$this->user_profile_model->update($data,$id);
			   //falsh data
				$this->session->set_flashdata('success', 'Sucessfully update.');


				redirect('user-profile');
			}
		}
		else
		{
			redirect('user-profile');
		}
	}
	function check_password($password)
	{	
		$id = $this->session->userdata('user_id');	
		$encrypted_pass = $this->user_profile_model->get_user_password($id);
		$d_password = $this->encryption->decrypt($encrypted_pass->user_password);
		if($password != $d_password)
		{
			$this->form_validation->set_message('check_password', 'The {field} field in invalid.');


			return false;
		}
		else
		{
			return true;
		}

	}


	function file_upload(){
		if($_FILES['file']['size'] > 0){
			$image = single_image_upload($_FILES['file'],'./uploads/user','png|jpeg|jpg');
			if(is_array($image)){            
				$this->session->set_flashdata('error', $image);
			}else{
				echo $data['file'] = $image;
			}
		}
	}

}
?>
