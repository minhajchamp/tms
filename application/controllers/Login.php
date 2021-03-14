<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends General_controller
{
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('login_model');
		$this->load->model('modules_model');
		$this->load->library('encryption');	
		
	}

	public function index()
	{	

		if(!empty($_POST['submit']))
		{	
			$this->form_validation->set_rules('email','Email','required|valid_email');
			$this->form_validation->set_rules('password','CurrentPassword','required|min_length[8]|max_length[20]');

			if($this->form_validation->run() == FALSE)
			{
				$data['view'] = 'login/login';
				$this->load->view('default-login',$data);
			}
			else
			{  
				$email = $this->input->post('email',TRUE);
				$password = $this->input->post('password');
				$remember_me = $this->input->post('remember_me');	
				$user = $this->login_model->get_user_by_email($email);
				if(!empty($user))
				{					
					$d_password = $this->encryption->decrypt($user->user_password);			
					if($password != $d_password)
					{
						$this->session->set_flashdata('error', 'Invalid Email or Password 1');
						redirect('login');
					}
					else
					{

						$modules = $this->modules_model->get_all();
						$modules_temp = array();
						foreach ($modules as $module) {
							$modules_temp[$module->modules_id] = $module;
						}
						
						if($remember_me == 'yes'){
							
							$cookie_email = array(
								'name'     => 'user_email',
								'value'    =>  $email,
								'expire'   =>  '1209600'
							);
							$this->input->set_cookie($cookie_email);
							$cookie_password = array(
								'name'    => 'user_password',
								'value'   =>  $password,
								'expire'  =>  '1209600',
							);
							$this->input->set_cookie($cookie_password);
						}						
						$data = array(
							'user_id'        => $user->user_id,
							'user_firstname' => $user->user_firstname,
							'user_lastname'  => $user->user_lastname,
							'user_email'     => $user->user_email,
							'login'          => 'active',
							'modules' 		 => json_encode($modules_temp),
							'user_module'    => json_encode($this->modules_model->get_all_by_user_id($user->user_id)),
						);

						$this->session->set_userdata($data);
						$this->session->set_flashdata('success', 'Sucessfully Login.');
						$this->logs->create('Logged in.');
						redirect();
					}
				}				
				else
				{
					$this->session->set_flashdata('error', 'Invalid Email or Password 2');
					redirect('login');					
				}
			}	
		}
		else
		{
			$data['view'] = 'login/login';
			$this->load->view('default-login',$data);
		}
	}
	
	public function logout()
	{
		$this->logs->create('Logged out.');
		$this->session->sess_destroy();
		redirect('login');
	}
	
	public function forget_password()
	{
		if(!empty($_POST['send_email']))
		{
			$this->form_validation->set_rules('email_forget_pass','Email','required|valid_email');
			if($this->form_validation->run() == FALSE)
			{
				$data['view'] = 'login/login';
				$this->load->view('default-login',$data);
			}
			else
			{
				$email_forget_pass = $this->input->post('email_forget_pass',TRUE);
				$user = $this->login_model->get_user_by_email($email_forget_pass);

				if(empty($user))
				{
					$this->session->set_flashdata('error', 'Invalid Email');
					redirect('login');
				}
				else
				{						
					$set_forgettokken = random_char_gen(20);
					$this->login_model->update_forgettoken($email_forget_pass,$set_forgettokken);
					$token = array('forget_tokken' => $set_forgettokken);
					echo $body = $this->load->view('default/login/reset_pass',$token,true);
					send_email($email_forget_pass,'link-email',$body);
				}
			}
		}
		else
		{
			$data['view'] = 'login/forget_password';
			$this->load->view('default-login',$data);
			
		}  
	}
	
	public function reset_password($token)
	{	
		if(!empty($_POST['submit']))
		{
			$this->form_validation->set_rules('newpassword','New Password','required|min_length[8]|max_length[20]');
			$this->form_validation->set_rules('confirmpassword','Confirm Password','required|matches[newpassword]');
			if($this->form_validation->run() == FALSE)
			{
				$data['view'] = 'login/reset_password';
				$this->load->view('default-login',$data);
			}
			else
			{
				$confirmpassword = $this->input->post('confirmpassword');
				$e_password = $this->encryption->encrypt($confirmpassword);
				$this->login_model->update_resetpass($e_password,$token);	
			}
		}
		else
		{
			$data['view'] = 'login/reset_password';
			$this->load->view('default-login',$data);
		}
	}
}
?>
