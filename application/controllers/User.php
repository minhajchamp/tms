<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends General_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');	
		$this->load->model('department_model');	
		$this->load->model('modules_model');
		$this->load->library('encryption');	
		
	}
	
	public function index()
	{
		$data['records'] = $this->user_model->get_all();
		$data['view']  = 'user/list_user';
		$this->load->view('default',$data);	
	}
	
	public function add()
	{
		$data['deptrecords'] = $this->department_model->get_all();
		$data['view'] = 'user/add_user';	
		$this->load->view('default',$data);	
		
	}
	
	public function edit($id)
	{
		$data['deptrecords'] = $this->department_model->get_all();
		$data['record'] = $this->user_model->show_user_data($id);	
		$data['view'] = 'user/update_user';	
		$this->load->view('default',$data);	
	}
	
   public function insert()
	{
		if(!empty($_POST))
		{
				$this->form_validation->set_rules('user_username','UserName','required|min_length[5]|max_length[20]');
				$this->form_validation->set_rules('user_firstname','FirstName','required|min_length[2]');
				$this->form_validation->set_rules('user_lastname','LastName','required|min_length[2]|max_length[20]');
				$this->form_validation->set_rules('department_id','Department Name','required|min_length[1]|max_length[20]');
				$this->form_validation->set_rules('user_email','Email','required|valid_email');
				
				
			
				if($this->form_validation->run() == FALSE)
				{
					$data['deptrecords'] = $this->department_model->get_all();
					$data['view'] = 'user/add_user';
					$this->load->view('default',$data);
			
				
			    }
			    else
			    {
					 $generate_password = random_char_gen(8);
				     $encrypt = $this->encryption->encrypt($generate_password);
				     
					$data = array(
						'department_id'          => $this->input->post('department_id'),
						'user_username'          => $this->input->post('user_username'),
						'user_firstname'         => $this->input->post('user_firstname'),
						'user_lastname'          => $this->input->post('user_lastname'),
						'user_email'             => $this->input->post('user_email'),
						'user_phonenumber'       => $this->input->post('user_phonenumber'),
						'user_address'           => $this->input->post('user_address'),
						'user_type'           	 => $this->input->post('user_type'),
						'user_status'            => 'active',
						'user_activity_by'       => $this->session->userdata('user_id'),
						'user_password'          => $encrypt,
					);
					$last_user_id = $this->user_model->insert($data);

					$user_modules = array(
						array(
							'module_id' => 1,
							'user_module_create' => 1,
							'user_module_read' => 1,
							'user_module_update' => 1,
							'user_module_delete' => 1,
							'user_module_status' => 'active',
							'user_id' => $last_user_id,
						),
						array(
							'module_id' => 2,
							'user_module_create' => 1,
							'user_module_read' => 1,
							'user_module_update' => 1,
							'user_module_delete' => 1,
							'user_module_status' => 'active',
							'user_id' => $last_user_id,
						),						
					);
					if(!empty($this->input->post('user_module'))){
						foreach($this->input->post('user_module') as $user_module_id => $user_module){
							$user_modules[] = array(
								'module_id' => $user_module_id,
								'user_module_create' => (!empty($user_module['user_module_create']) && $user_module['user_module_create'] == 1)?'1':'',
								'user_module_read' => (!empty($user_module['user_module_read']) && $user_module['user_module_read'] == 1)?'1':'',
								'user_module_update' => (!empty($user_module['user_module_update']) && $user_module['user_module_update'] == 1)?'1':'',
								'user_module_delete' => (!empty($user_module['user_module_delete']) && $user_module['user_module_delete'] == 1)?'1':'',
								'user_module_status' => 'active',
								'user_id' => $last_user_id,
							);
						}
					}


					$this->modules_model->insert_batch($user_modules);

					$this->session->set_flashdata('success', 'Sucessfully Inserted.');
					
					echo "Email:".$email_pass['user_email'] = $this->input->post('user_email'); 
					echo "<br>";
					echo "password:".$email_pass['password']   = $generate_password; 
				  
					echo $body = $this->load->view('default/user/user_pass',$email_pass,true);
				    send_email($email_pass['user_email'],'link-email',$body);
				  
					//redirect('user');
				}
		}
	}
	
	public function update($id)
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
				$this->form_validation->set_rules('department_id','Department Name','required|min_length[1]|max_length[20]');

				
				if($this->form_validation->run() == FALSE)
				{
					$data['deptrecords'] = $this->department_model->get_all();
					$data['view'] = 'user/update_user';
					$this->load->view('default',$data);
				
			    }
			    else
			    {
				 $current_pass = $this->input->post('user_password',true); 
		         $new_pass  = $this->input->post('newpassword',true); 
		         $confirm_pass = $this->input->post('confirm_newpassword',true);
		         				
								$data['user_username']    = $this->input->post('user_username',true);
								$data['user_firstname']   = $this->input->post('user_firstname',true);
								$data['user_lastname']    = $this->input->post('user_lastname',true);
								$data['user_email']       = $this->input->post('user_email',true);
								$data['user_phonenumber'] = $this->input->post('user_phonenumber',true);
								$data['user_address']     = $this->input->post('user_address',true);
								$data['department_id']    = $this->input->post('department_id');
								$data['user_type']		  = $this->input->post('user_type', true);
								$data['user_status']      = 'active';
						        $data['user_activity_by'] = '1';
						
						if(!empty($current_pass) && !empty($new_pass) && !empty($confirm_pass))
						{
							
							$data['user_password'] = $this->encryption->encrypt($this->input->post('user_password'));
							
					     }
					     
					$id = $this->session->userdata('user_id');	
					$this->user_model->update($data,$id);
					$this->session->set_flashdata('success', 'Sucessfully Updated.');
					redirect('user');
 				}
	    }		
			  else
		     {
			   redirect('user');
		     }
    }
     function check_password($password)
    {	
		  $id = $this->session->userdata('user_id');	
		  $encrypted_pass = $this->user_model->get_user_password($id);
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
    public function delete($id)
    {
		$this->user_model->delete($id);
		$this->session->set_flashdata('Deleted', 'Record Sucessfully Deleted.');
		redirect('user');
	}
}

?>
