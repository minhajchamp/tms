<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_school extends General_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');	
		$this->load->model('school_model');	
		$this->load->model('campus_model');	
		$this->load->library('encryption');			
	}
	
	public function index()
	{
		$data['records'] = $this->user_model->get_all_school_users();
		$data['view']  = 'user_school/list_user';
		$this->load->view('default',$data);	
	}
	
	public function add()
	{
		$data['schoolrecords'] = $this->school_model->get_all();
		$data['campusrecords'] = $this->campus_model->get_all();
		$data['view'] = 'user_school/add_user';	
		$this->load->view('default',$data);	
		
	}
	
	public function edit($id)
	{
		$data['schoolrecords'] = $this->school_model->get_all();
		$data['campusrecords'] = $this->campus_model->get_all();
		$data['record'] = $this->user_model->show_user_data($id);	
		$data['view'] = 'user_school/update_user';	
		$this->load->view('default',$data);	
	}
	
   public function insert()
	{
		if(!empty($_POST))
		{
		
				$this->form_validation->set_rules('user_firstname','FirstName','required|min_length[2]');
				
				
			
				if($this->form_validation->run() == FALSE)
				{
					$data['view'] = 'user_school/add_user';
					$this->load->view('default',$data);
				}
			    else
			    {
				    $generate_password = random_char_gen(8);
			        $encrypt = $this->encryption->encrypt($generate_password);
			        $data = array(
						'user_username'          => $this->input->post('user_username'),
						'user_firstname'         => $this->input->post('user_firstname'),
						'user_lastname'          => $this->input->post('user_lastname'),
						'user_email'             => $this->input->post('user_email'),
						'user_phonenumber'       => $this->input->post('user_phonenumber'),
						'user_address'           => $this->input->post('user_address'),
						'user_status'            => 'active',
						'user_type'				 => 'school',
						'user_activity_by'       => $this->session->userdata('user_id'),
						'user_password'          => $encrypt,
					);

					$last_user_id = $this->user_model->insert($data);
					$this->session->set_flashdata('success', 'Sucessfully Inserted.');
						
					$data2 = array(
						'school_id' => $this->input->post('school_id'),
						'campus_id' => $this->input->post('campus_id'),
						'user_id' => $last_user_id,
					);	
					$this->user_model->assign_school($data2);


					echo "Email:".$email_pass['user_email'] = $this->input->post('user_email'); 
					echo "<br>";
					echo "password:".$email_pass['password']   = $generate_password; 
				  
					//echo $body = $this->load->view('default/user_school/user_pass',$email_pass,true);
				    send_email($email_pass['user_email'],'link-email',$body);
				  
					redirect('user_school');
				}
		}
	}
	
	public function update($id)
	{
		if(!empty($_POST))
		{     
			
				$this->form_validation->set_rules('user_firstname','FirstName','required|min_length[2]');

				
				if($this->form_validation->run() == FALSE)
				{
					$data['view'] = 'user_school/update_user';
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

						$data['user_status']      = 'active';
				        $data['user_activity_by'] = '1';
				
						if(!empty($current_pass) && !empty($new_pass) && !empty($confirm_pass))
						{
							
								$data['user_password'] = $this->encryption->encrypt($this->input->post('user_password'));
							
					     }
					     
					$id = $this->session->userdata('user_id');	
					$this->user_model->update($data,$id);


					$data2 = array(
						'school_id' => $this->input->post('school_id'),
						'campus_id' => $this->input->post('campus_id'),
					);	
					$this->user_model->update_school($data2,$id);


					$this->session->set_flashdata('success', 'Sucessfully Updated.');
					redirect('user_school');
 				}
	    }		
			  else
		     {
			   redirect('user_school');
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
		redirect('user_school');
	}
}

?>
